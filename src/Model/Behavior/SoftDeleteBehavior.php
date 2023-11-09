<?php
declare(strict_types=1);

namespace Reincarnation\Model\Behavior;

use ArrayObject;
use Cake\Event\EventInterface;
use Cake\I18n\DateTime;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validation;

class SoftDeleteBehavior extends Behavior
{
    // デフォルト設定
    protected array $_defaultConfig = [
        'boolean' => 'deleted',
        'timestamp' => 'deleted_date',
    ];

    /**
     * beforeFind
     *
     * @param \Cake\Event\EventInterface $event
     * @param \Cake\ORM\Query\SelectQuery $query
     * @param \ArrayObject $options
     * @param bool $primary
     * @return void
     */
    public function beforeFind(EventInterface $event, SelectQuery $query, ArrayObject $options, bool $primary): void
    {
        $getOptions = $query->getOptions();
        if (!array_key_exists('enableSoftDelete', $getOptions)
            || $getOptions['enableSoftDelete'] == true
        ) {
            $modelName = $this->_table->getAlias();
            $booleanField = $this->getConfig('boolean');
            $timestampField = $this->getConfig('timestamp');
            if ($booleanField !== false && $this->_table->hasField($booleanField)) {
                $query->where([$modelName . '.' . $booleanField => false]);
            }
            if ($booleanField === false && $timestampField !== false && $this->_table->hasField($timestampField)) {
                $query->where([$modelName . '.' . $timestampField . ' IS' => null]);
            }
        }
    }

    /**
     * softDelete
     *
     * @param \Cake\ORM\Entity $deleteEntity
     * @param bool $associate
     * @return bool
     */
    public function softDelete(Entity $deleteEntity, bool $associate = false): bool
    {
        //データがぞんざいしない場合はエラー
        if (!$this->dataExist($deleteEntity->{$this->_table->getPrimaryKey()})) {
            return false;
        }

        $id = $deleteEntity->{$this->_table->getPrimaryKey()};

        $now = new DateTime();

        $deleteData = [];
        if ($this->getConfig('boolean') !== false) {
            $deleteData[$this->getConfig('boolean')] = true;
        }
        if ($this->getConfig('timestamp') !== false) {
            $deleteData[$this->getConfig('timestamp')] = $now;
        }
        $saveEntity = $this->_table->patchEntity(
            $deleteEntity,
            $deleteData,
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
        if ($result === false
            || $associate === false
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
            } elseif (is_array($deleteEntity->{$property})) {
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
     *
     * @param int $id
     * @return bool
     */
    private function dataExist(int $id): bool
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
     *
     * @param mixed $property
     * @param bool $associate
     * @return bool
     */
    private function propertyDelete($property, bool $associate): bool
    {
        $result = true;
        //プロパティがEntityなら消しにかかる
        if (is_object($property)
            // 該当objectがEntityかどうかチェック
            && array_key_exists('Cake\\Datasource\\EntityInterface', class_implements($property))
        ) {
            //該当EntityのTableを取得
            $associateTable = TableRegistry::getTableLocator()->get($property->getSource());
            if (!$associateTable->softDelete($property, $associate)) {
                $result = false;
            }
        }

        return $result;
    }

    /**
     * strictExistIn
     *
     * SoftDeletableを無視した厳密な存在チェック
     *
     * @param \Cake\ORM\Entity $entity
     * @param array $options
     * @return bool
     */
    public function strictExistIn(Entity $entity, array $options): bool
    {
        if (!isset($options['sourceModel'])
            || !isset($options['targetField'])
        ) {
            return false;
        }

        $sourceModel = $options['sourceModel'];
        $sourceTable = TableRegistry::getTableLocator()->get($sourceModel);

        $targetField = $options['targetField'];
        $conditions = [
            $sourceModel . '.' . $sourceTable->primaryKey() => $entity->{$targetField},
        ];

        return (bool)count(
            $sourceTable
                ->find('all', enableSoftDelete: false)
                ->select(['existing' => 1])
                ->where($conditions)
                ->limit(1)
                ->toArray()
        );
    }
}
