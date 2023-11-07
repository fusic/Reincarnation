<?php
namespace Reincarnation\Test\App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HobbiesMembers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Hobbies
 * @property \Cake\ORM\Association\BelongsTo $Members
 */
class HobbiesMembersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('hobbies_members');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Hobbies', [
            'foreignKey' => 'hobby_id',
            'className' => 'Reincarnation\Test\App\Model\Table\HobbiesTable',
        ]);
        $this->belongsTo('Members', [
            'foreignKey' => 'member_id',
            'className' => 'Reincarnation\Test\App\Model\Table\MembersTable',
        ]);

        $this->addBehavior('Reincarnation.SoftDelete');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['hobby_id'], 'Hobbies'));
        $rules->add($rules->existsIn(['member_id'], 'Members'));
        return $rules;
    }
}
