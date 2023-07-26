<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClipImages Model
 *
 * @property \App\Model\Table\ClipsTable&\Cake\ORM\Association\BelongsTo $Clips
 *
 * @method \App\Model\Entity\ClipImage newEmptyEntity()
 * @method \App\Model\Entity\ClipImage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ClipImage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClipImage get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClipImage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ClipImage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClipImage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClipImage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClipImage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClipImage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClipImage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClipImage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClipImage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClipImagesTable extends Table
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

        $this->setTable('clip_images');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clips', [
            'foreignKey' => 'clip_id',
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
            ->integer('clip_id')
            ->allowEmptyString('clip_id');

        $validator
            ->scalar('filename')
            ->maxLength('filename', 255)
            ->requirePresence('filename', 'create')
            ->notEmptyFile('filename');

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
        $rules->add($rules->existsIn('clip_id', 'Clips'), ['errorField' => 'clip_id']);

        return $rules;
    }
}
