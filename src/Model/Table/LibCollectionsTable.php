<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LibCollections Model
 *
 * @property \App\Model\Table\BookCollectionsTable&\Cake\ORM\Association\HasMany $BookCollections
 *
 * @method \App\Model\Entity\LibCollection newEmptyEntity()
 * @method \App\Model\Entity\LibCollection newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LibCollection[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LibCollection get($primaryKey, $options = [])
 * @method \App\Model\Entity\LibCollection findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LibCollection patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LibCollection[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LibCollection|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LibCollection saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LibCollection[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LibCollection[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LibCollection[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LibCollection[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LibCollectionsTable extends Table
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

        $this->setTable('lib_collections');
        $this->setDisplayField('label');
        $this->setPrimaryKey('id');

        $this->hasMany('BookCollections', [
            'foreignKey' => 'lib_collection_id',
        ]);

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always',
                ],
            ]
        ]);
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('lib_count')
            ->notEmptyString('lib_count');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }
}
