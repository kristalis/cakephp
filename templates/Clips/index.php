<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Book> $clips
 */
?>
<div class="clips index content">
    <?= $this->Html->link(__('New Book'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Clips') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clips as $clip): ?>
                <tr>
                    <td><?= $this->Number->format($clip->id) ?></td>
                    <td><?= h($clip->name) ?></td>
                    <td><?= h($clip->created_at) ?></td>
                    <td><?= h($clip->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $clip->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $clip->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $clip->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clip->id)]) ?>
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
