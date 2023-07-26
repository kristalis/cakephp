<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClipCollections Model
 *
 * @property \App\Model\Table\ScreenCollectionsTable&\Cake\ORM\Association\BelongsTo $ScreenCollections
 * @property \App\Model\Table\ClipsTable&\Cake\ORM\Association\BelongsToMany $Clips
 *
 * @method \App\Model\Entity\ClipCollection newEmptyEntity()
 * @method \App\Model\Entity\ClipCollection newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ClipCollection[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClipCollection get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClipCollection findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ClipCollection patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClipCollection[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClipCollection|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClipCollection saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClipCollection[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClipCollection[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClipCollection[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClipCollection[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClipCollectionsTable extends Table
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

        $this->setTable('clip_collections');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ScreenCollections', [
            'foreignKey' => 'screen_collection_id',
        ]);
        $this->belongsToMany('Clips', [
            'foreignKey' => 'clip_collection_id',
            'targetForeignKey' => 'clip_id',
            'joinTable' => 'clip_collections_items',
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
            ->integer('screen_collection_id')
            ->allowEmptyString('screen_collection_id');

        $validator
            ->date('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmptyDate('start_date');

        $validator
            ->date('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmptyDate('end_date');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

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
        $rules->add($rules->existsIn('screen_collection_id', 'ScreenCollections'), ['errorField' => 'screen_collection_id']);

        return $rules;
    }
}
