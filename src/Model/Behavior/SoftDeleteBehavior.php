<?php

namespace Reincarnation\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Event\Event;
use Cake\ORM\Query;
use ArrayObject;
use Cake\I18n\Time;
use Cake\Validation\Validation;

class SoftDeleteBehavior extends Behavior {

    public function beforeFind(Event $event, Query $query, ArrayObject $options, $primary){
        $getOptions = $query->getOptions();
        if (
            !array_key_exists('enableSoftDelete',$getOptions) ||
            $getOptions['enableSoftDelete'] == false
        ){
            $modelName = $this->_table->alias();
            $query->where([$modelName . '.deleted' => false]);
        }
    }

    public function softDelete($entity){
        //データがぞんざいしない場合はエラー
        if (!$this->dataExist($entity->id)){
            return false;
        }

        $id = $entity->{$this->_table->primaryKey()};

        $now = Time::now()->i18nFormat('YYYY/MM/dd HH:mm:ss');
        $delete_data = [
            $this->_table->primaryKey() => $id,
            'deleted' => true,
            'deleted_date' => $now
        ];
        $entity = $this->_table->newEntity(
            $delete_data,
            //バリデーションはかけない
            ['validate' => false]
        );
        $behavior = $this;

        $result = $this->_table->connection()->transactional(function () use ($behavior, $entity, $id) {
            //削除データの保存に失敗
            if (!$behavior->_table->save($entity,['atomic' => false])){
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
