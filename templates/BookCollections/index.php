<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\BookCollection> $bookCollections
 */
?>
<div class="bookCollections index content">
    <?= $this->Html->link(__('New Book Collection'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Book Collections') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('lib_collection_id') ?></th>
                    <th><?= $this->Paginator->sort('start_date') ?></th>
                    <th><?= $this->Paginator->sort('end_date') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookCollections as $bookCollection): ?>
                <tr>
                    <td><?= $this->Number->format($bookCollection->id) ?></td>
                    <td><?= h($bookCollection->name) ?></td>
                    <td><?= $bookCollection->has('lib_collection') ? $this->Html->link($bookCollection->lib_collection->name, ['controller' => 'LibCollections', 'action' => 'view', $bookCollection->lib_collection->id]) : '' ?></td>
                    <td><?= h($bookCollection->start_date) ?></td>
                    <td><?= h($bookCollection->end_date) ?></td>
                    <td><?= h($bookCollection->created_at) ?></td>
                    <td><?= h($bookCollection->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $bookCollection->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bookCollection->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bookCollection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookCollection->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
