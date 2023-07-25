<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LibCollection $libCollection
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Lib Collection'), ['action' => 'edit', $libCollection->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Lib Collection'), ['action' => 'delete', $libCollection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $libCollection->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Lib Collections'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Lib Collection'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="libCollections view content">
            <h3><?= h($libCollection->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($libCollection->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($libCollection->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lib Count') ?></th>
                    <td><?= $this->Number->format($libCollection->lib_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($libCollection->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($libCollection->updated_at) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Book Collections') ?></h4>
                <?php if (!empty($libCollection->book_collections)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Lib Collection Id') ?></th>
                            <th><?= __('Start Date') ?></th>
                            <th><?= __('End Date') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th><?= __('Updated At') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($libCollection->book_collections as $bookCollections) : ?>
                        <tr>
                            <td><?= h($bookCollections->id) ?></td>
                            <td><?= h($bookCollections->name) ?></td>
                            <td><?= h($bookCollections->lib_collection_id) ?></td>
                            <td><?= h($bookCollections->start_date) ?></td>
                            <td><?= h($bookCollections->end_date) ?></td>
                            <td><?= h($bookCollections->created_at) ?></td>
                            <td><?= h($bookCollections->updated_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'BookCollections', 'action' => 'view', $bookCollections->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'BookCollections', 'action' => 'edit', $bookCollections->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'BookCollections', 'action' => 'delete', $bookCollections->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookCollections->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
