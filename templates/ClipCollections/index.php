<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ClipCollection> $clipCollections
 */
?>
<div class="clipCollections index content">
    <?= $this->Html->link(__('New Clip Collection'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Clip Collections') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('screen_collection_id') ?></th>
                    <th><?= $this->Paginator->sort('start_date') ?></th>
                    <th><?= $this->Paginator->sort('end_date') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clipCollections as $clipCollection): ?>
                <tr>
                    <td><?= $this->Number->format($clipCollection->id) ?></td>
                    <td><?= h($clipCollection->name) ?></td>
                    <td><?= $clipCollection->has('screen_collection') ? $this->Html->link($clipCollection->screen_collection->name, ['controller' => 'ScreenCollections', 'action' => 'view', $clipCollection->screen_collection->id]) : '' ?></td>
                    <td><?= h($clipCollection->start_date) ?></td>
                    <td><?= h($clipCollection->end_date) ?></td>
                    <td><?= h($clipCollection->created_at) ?></td>
                    <td><?= h($clipCollection->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $clipCollection->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $clipCollection->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $clipCollection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clipCollection->id)]) ?>
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
