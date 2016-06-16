<?php
namespace Reincarnation\Test\App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Members Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BloodTypes
 * @property \Cake\ORM\Association\HasMany $Addresses
 * @property \Cake\ORM\Association\HasMany $Tels
 * @property \Cake\ORM\Association\BelongsToMany $Hobbies
 */
class MembersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('members');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('BloodTypes', [
            'className' => 'Reincarnation\Test\App\Model\Table\BloodTypesTable',
            'foreignKey' => 'blood_type_id'
        ]);
        $this->hasOne('Addresses', [
            'className' => 'Reincarnation\Test\App\Model\Table\AddressesTable',
            'foreignKey' => 'member_id'
        ]);
        $this->hasMany('Tels', [
            'className' => 'Reincarnation\Test\App\Model\Table\TelsTable',
            'foreignKey' => 'member_id'
        ]);
        $this->belongsToMany('Hobbies', [
            'className' => 'Reincarnation\Test\App\Model\Table\HobbiesTable',
            'foreignKey' => 'member_id',
            'targetForeignKey' => 'hobby_id',
            'joinTable' => 'hobbies_members'
        ]);

        //softdelete
        $this->addBehavior('Reincarnation.SoftDelete');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['blood_type_id'], 'BloodTypes'));
        return $rules;
    }
}
