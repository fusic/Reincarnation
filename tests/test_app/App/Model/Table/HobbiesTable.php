<?php
declare(strict_types=1);

namespace Reincarnation\Test\App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Hobbies Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Members
 */
class HobbiesTable extends Table
{
    /**
     * Initialize method
     *
     * @param  array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('hobbies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Members', [
            'foreignKey' => 'hobby_id',
            'targetForeignKey' => 'member_id',
            'joinTable' => 'hobbies_members',
            'className' => 'Reincarnation\Test\App\Model\Table\MembersTable',
        ]);

        $this->addBehavior('Reincarnation.SoftDelete');
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
            ->integer('id')
            ->allowEmptyString('id', 'create');
        /*
        $validator
            ->notEmpty('_ids')
            ->add('_ids', 'multiple', [
                'rule' => ['min', 1],
                'message' => 'hogehoge'
            ]);
        */
        return $validator;
    }
}
