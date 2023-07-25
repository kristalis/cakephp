<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BookCollectionsBooks Model
 *
 * @property \App\Model\Table\BookCollectionsTable&\Cake\ORM\Association\BelongsTo $BookCollections
 * @property \App\Model\Table\BooksTable&\Cake\ORM\Association\BelongsTo $Books
 *
 * @method \App\Model\Entity\BookCollectionsBook newEmptyEntity()
 * @method \App\Model\Entity\BookCollectionsBook newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BookCollectionsBook[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BookCollectionsBook get($primaryKey, $options = [])
 * @method \App\Model\Entity\BookCollectionsBook findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BookCollectionsBook patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BookCollectionsBook[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BookCollectionsBook|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BookCollectionsBook saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BookCollectionsBook[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BookCollectionsBook[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BookCollectionsBook[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BookCollectionsBook[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BookCollectionsBooksTable extends Table
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

        $this->setTable('book_collections_books');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('BookCollections', [
            'foreignKey' => 'book_collection_id',
        ]);
        $this->belongsTo('Books', [
            'foreignKey' => 'book_id',
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
            ->integer('book_collection_id')
            ->allowEmptyString('book_collection_id');

        $validator
            ->integer('book_id')
            ->allowEmptyString('book_id');

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
        $rules->add($rules->existsIn('book_collection_id', 'BookCollections'), ['errorField' => 'book_collection_id']);
        $rules->add($rules->existsIn('book_id', 'Books'), ['errorField' => 'book_id']);

        return $rules;
    }
}
