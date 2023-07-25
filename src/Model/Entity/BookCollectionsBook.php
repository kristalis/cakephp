<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BookCollectionsBook Entity
 *
 * @property int $id
 * @property int|null $book_collection_id
 * @property int|null $book_id
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 *
 * @property \App\Model\Entity\BookCollection $book_collection
 * @property \App\Model\Entity\Book $book
 */
class BookCollectionsBook extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'book_collection_id' => true,
        'book_id' => true,
        'created_at' => true,
        'updated_at' => true,
        'book_collection' => true,
        'book' => true,
    ];
}
