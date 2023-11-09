<?php
declare(strict_types=1);

namespace Reincarnation\Test\App\Model\Table;

use Cake\Validation\Validator;
use Reincarnation\Test\App\Model\Table\AppTable;

/**
 * BloodTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $Members
 */
class BloodTypesTable extends AppTable
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

        $this->setTable('blood_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Members', [
            'foreignKey' => 'blood_type_id',
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

        $validator
            ->allowEmptyString('name');

        return $validator;
    }
}
