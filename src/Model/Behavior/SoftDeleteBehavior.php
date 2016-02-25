<?php

namespace Reincarnation\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Event\Event;
use Cake\ORM\Query;
use ArrayObject;
use Cake\I18n\Time;
use Cake\Validation\Validation;

class SoftDeleteBehavior extends Behavior {

    // デフォルト設定
    protected $_defaultConfig = [
        'boolean' => 'deleted',
        'timestamp' => 'deleted_date'
    ];

    public function beforeFind(Event $event, Query $query, ArrayObject $options, $primary){
        $getOptions = $query->getOptions();
        if (
            !array_key_exists('enableSoftDelete',$getOptions) ||
            $getOptions['enableSoftDelete'] == true
        ){
            $modelName = $this->_table->alias();
            if ($this->config('boolean') !== false){
                $query->where([$modelName . '.' . $this->_config['boolean'] => false]);
            }
            if ($this->_config['boolean'] === false && $this->_config['timestamp'] !== false){
                $query->where([$modelName . '.' . $this->_config['timestamp'].' IS' => null]);
            }
        }
    }

    public function softDelete($deleteEntity){
        //データがぞんざいしない場合はエラー
        if (!$this->dataExist($deleteEntity->{$this->_table->primaryKey()})){
            return false;
        }

        $id = $deleteEntity->{$this->_table->primaryKey()};

        $now = Time::now()->i18nFormat('YYYY/MM/dd HH:mm:ss');

        $delete_data = [];
        if ($this->_config['boolean'] !== false){
            $delete_data[$this->_config['boolean']] = true;
        }
        if ($this->_config['timestamp'] !== false){
            $delete_data[$this->_config['timestamp']] = $now;
        }
        $saveEntity = $this->_table->newEntity(
            $delete_data,
            //バリデーションはかけない
            ['validate' => false]
        );
        $saveEntity->{$this->_table->primaryKey()} = $id;

        $behavior = $this;

        $result = $this->_table->connection()->transactional(function () use ($behavior, $saveEntity, $id) {
            //削除データの保存に失敗
            if (!$behavior->_table->save($saveEntity,['atomic' => false])){
                return false;
            }
            //最終的に存在していなければOK
            if ($behavior->dataExist($id)){
                return false;
            }
            return true;
        });

        return $result;
    }

    private function dataExist($id){
        //数値などのチェック
        if (!$id || !Validation::naturalNumber($id)){
            return false;
        }

        $data = $this->_table->find()
        ->where([$this->_table->alias() . '.' . $this->_table->primaryKey() => $id])
        ->first();
        ;
        return !empty($data);
    }

}
