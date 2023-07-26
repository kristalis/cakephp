<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ScreenCollections Model
 *
 * @property \App\Model\Table\ClipCollectionsTable&\Cake\ORM\Association\HasMany $ClipCollections
 *
 * @method \App\Model\Entity\ScreenCollection newEmptyEntity()
 * @method \App\Model\Entity\ScreenCollection newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ScreenCollection[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ScreenCollection get($primaryKey, $options = [])
 * @method \App\Model\Entity\ScreenCollection findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ScreenCollection patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ScreenCollection[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ScreenCollection|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ScreenCollection saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ScreenCollection[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ScreenCollection[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ScreenCollection[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ScreenCollection[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ScreenCollectionsTable extends Table
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

        $this->setTable('screen_collections');
        $this->setDisplayField('label');
        $this->setPrimaryKey('id');

        $this->hasMany('ClipCollections', [
            'foreignKey' => 'screen_collection_id',
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
            ->integer('screen_count')
            ->notEmptyString('screen_count');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }
}
