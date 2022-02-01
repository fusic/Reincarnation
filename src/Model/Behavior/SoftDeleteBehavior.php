<?php

namespace Reincarnation\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Event\Event;
use Cake\ORM\Query;
use ArrayObject;
use Cake\I18n\Time;
use Cake\Validation\Validation;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\EntityInterface;



class SoftDeleteBehavior extends Behavior {

    // デフォルト設定
    protected $_defaultConfig = [
        'boolean' => 'deleted',
        'timestamp' => 'deleted_date'
    ];

    /**
     * beforeFind
     * @param Event $event
     * @param Query $query
     * @param ArrayObject $options
     * @param $primary
     */
    public function beforeFind(Event $event, Query $query, ArrayObject $options, $primary)
    {
        $getOptions = $query->getOptions();
        if (
            !array_key_exists('enableSoftDelete', $getOptions) ||
            $getOptions['enableSoftDelete'] == true
        ){
            $modelName = $this->_table->getAlias();
            $booleanField = $this->getConfig('boolean');
            $timestampField = $this->getConfig('timestamp');
            if ($booleanField !== false && $this->_table->hasField($booleanField)) {
                $query->where([$modelName . '.' . $booleanField => false]);
            }
            if ($booleanField === false && $timestampField !== false && $this->_table->hasField($timestampField)) {
                $query->where([$modelName . '.' . $timestampField .' IS' => null]);
            }
        }
    }

    /**
     * softDelete
     * @param Entity $deleteEntity
     * @param Boolean $associate
     */
    public function softDelete($deleteEntity, $associate = false)
    {
        //データがぞんざいしない場合はエラー
        if (!$this->dataExist($deleteEntity->{$this->_table->getPrimaryKey()})){
            return false;
        }

        $id = $deleteEntity->{$this->_table->getPrimaryKey()};

        $now = Time::now();

        $delete_data = [];
        if ($this->getConfig('boolean') !== false) {
            $delete_data[$this->getConfig('boolean')] = true;
        }
        if ($this->getConfig('timestamp') !== false) {
            $delete_data[$this->getConfig('timestamp')] = $now;
        }
        $saveEntity = $this->_table->patchEntity(
            $deleteEntity,
            $delete_data,
            //バリデーションはかけない
            ['validate' => false]
        );
        $saveEntity->{$this->_table->getPrimaryKey()} = $id;

        $behavior = $this;

        $result = true;
        //削除データの保存に失敗
        if (!$behavior->_table->save($saveEntity, ['atomic' => false])) {
            $result = false;
        }
        //最終的に存在していなければOK
        if ($behavior->dataExist($id)) {
            $result = false;
        }

        //リレーションを見ない設定の場合はそのまま返す
        if (
            $result === false ||
            $associate === false
        ) {
            return $result;
        }

        //アクセス可能なプロパティを見る
        $properties = $deleteEntity->getVisible();
        foreach ($properties as $property) {
            //該当プロパティがEntityなら
            //hasone / belongsto /habtmの中間テーブル
            if (!$this->propertyDelete($deleteEntity->{$property}, $associate)) {
                $result = false;
            } else if (is_array($deleteEntity->{$property})) {
                //hasmany / habtm
                foreach ($deleteEntity->{$property} as $hasmanyProperty) {
                    if (!$this->propertyDelete($hasmanyProperty, $associate)) {
                        $result = false;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * dataExist
     * @param Integer $id
     */
    private function dataExist($id)
    {
        //数値などのチェック
        if (!$id || !Validation::naturalNumber($id)) {
            return false;
        }

        $data = $this->_table->find()
            ->where([$this->_table->getAlias() . '.' . $this->_table->getPrimaryKey() => $id])
            ->first();
        return !empty($data);
    }

    /**
     * propertyDelete
     * @param Entity $property
     * @param Boolean $associate
     */
    private function propertyDelete($property, $associate)
    {
        $result = true;
        //プロパティがEntityなら消しにかかる
        if (
            is_object($property) &&
            // 該当objectがEntityかどうかチェック
            array_key_exists('Cake\\Datasource\\EntityInterface', class_implements($property))
        ) {
            //該当EntityのTableを取得
            $associateTable = TableRegistry::get($property->getSource());
            if (!$associateTable->softDelete($property, $associate)) {
                $result = false;
            }
        }
        return $result;
    }

    ############################################################
    #### For Validation
    /**
     * strictExistIn
     *
     * SoftDeletableを無視した厳密な存在チェック
     * @param $entity Entity
     * @param Array   options
     */
    public function strictExistIn(Entity $entity, $options)
    {
        if (
            !isset($options['sourceModel']) ||
            !isset($options['targetField'])
            ) {
            return false;
        }

        $sourceModel = $options['sourceModel'];
        $sourceTable = TableRegistry::get($sourceModel);

        $targetField = $options['targetField'];
        $conditions  = [
            $sourceModel . '.' . $sourceTable->primaryKey() => $entity->{$targetField}
        ];

        return (bool)count(
                    $sourceTable
                    ->find('all', [
                        'enableSoftDelete' => false
                    ])
                    ->select(['existing' => 1])
                    ->where($conditions)
                    ->limit(1)
                    ->hydrate(false)
                    ->toArray()
                );
    }

}
