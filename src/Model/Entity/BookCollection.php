<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BookCollection Entity
 *
 * @property int $id
 * @property string $name
 * @property int|null $lib_collection_id
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 *
 * @property \App\Model\Entity\LibCollection $lib_collection
 * @property \App\Model\Entity\Book[] $books
 */
class BookCollection extends Entity
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
        'name' => true,
        'lib_collection_id' => true,
        'start_date' => true,
        'end_date' => true,
        'created_at' => true,
        'updated_at' => true,
        'lib_collection' => true,
        'books' => true,
    ];
}
