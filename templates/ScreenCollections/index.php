<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ScreenCollection> $screenCollections
 */
?>
<div class="screenCollections index content">
    <?= $this->Html->link(__('New Lib Collection'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Lib Collections') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('screen_count') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($screenCollections as $screenCollection): ?>
                <tr>
                    <td><?= $this->Number->format($screenCollection->id) ?></td>
                    <td><?= h($screenCollection->name) ?></td>
                    <td><?= $this->Number->format($screenCollection->screen_count) ?></td>
                    <td><?= h($screenCollection->created_at) ?></td>
                    <td><?= h($screenCollection->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $screenCollection->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $screenCollection->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $screenCollection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $screenCollection->id)]) ?>
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
