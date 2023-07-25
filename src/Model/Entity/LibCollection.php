<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LibCollection Entity
 *
 * @property int $id
 * @property string $name
 * @property int $lib_count
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 *
 * @property \App\Model\Entity\BookCollection[] $book_collections
 */
class LibCollection extends Entity
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
        'lib_count' => true,
        'created_at' => false,
        'updated_at' => false,
        'book_collections' => true,
    ];

    protected function _getLabel()
    {
        return isset($this->_fields['name']) && isset($this->_fields['lib_count']) ? $this->_fields['name'] . ' ' . $this->_fields['lib_count'] : '';
    }
}
