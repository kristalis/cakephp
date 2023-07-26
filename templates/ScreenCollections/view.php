<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ScreenCollection $screenCollection
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Lib Collection'), ['action' => 'edit', $screenCollection->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Lib Collection'), ['action' => 'delete', $screenCollection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $screenCollection->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Lib Collections'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Lib Collection'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="screenCollections view content">
            <h3><?= h($screenCollection->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($screenCollection->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($screenCollection->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lib Count') ?></th>
                    <td><?= $this->Number->format($screenCollection->screen_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($screenCollection->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($screenCollection->updated_at) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Book Collections') ?></h4>
                <?php if (!empty($screenCollection->clip_collections)) : ?>
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
                        <?php foreach ($screenCollection->clip_collections as $clipCollections) : ?>
                        <tr>
                            <td><?= h($clipCollections->id) ?></td>
                            <td><?= h($clipCollections->name) ?></td>
                            <td><?= h($clipCollections->screen_collection_id) ?></td>
                            <td><?= h($clipCollections->start_date) ?></td>
                            <td><?= h($clipCollections->end_date) ?></td>
                            <td><?= h($clipCollections->created_at) ?></td>
                            <td><?= h($clipCollections->updated_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ClipCollections', 'action' => 'view', $clipCollections->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ClipCollections', 'action' => 'edit', $clipCollections->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ClipCollections', 'action' => 'delete', $clipCollections->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clipCollections->id)]) ?>
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
