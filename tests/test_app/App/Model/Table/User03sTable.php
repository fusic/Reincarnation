<?php
declare(strict_types=1);

namespace Reincarnation\Test\App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Reincarnation\Test\App\Model\Table\AppTable;

/**
 * User03s Model
 *
 * DBに削除フラグは無し、削除日時のみの場合のテストコード
 */
class User03sTable extends AppTable
{
    /**
     * Initialize method
     *
     * @param  array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        $this->setTable('user03s');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

        // 削除日時のみ使用
        $this->addBehavior('Reincarnation.SoftDelete', ['boolean' => false, 'timestamp' => 'deleted']);
    }

    /**
     * Default validation rules.
     *
     * @param  \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmptyString('id', 'create');

        $validator
            ->allowEmptyString('name');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param  \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        return $rules;
    }
}
