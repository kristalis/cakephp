<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClipCollectionsItem Entity
 *
 * @property int $id
 * @property int|null $clip_collection_id
 * @property int|null $clip_id
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 *
 * @property \App\Model\Entity\ClipCollection $clip_collection
 * @property \App\Model\Entity\Book $clip
 */
class ClipCollectionsItem extends Entity
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
        'clip_collection_id' => true,
        'clip_id' => true,
        'created_at' => true,
        'updated_at' => true,
        'clip_collection' => true,
        'clip' => true,
    ];
}
