<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClipCollection $clipCollection
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Clip Collection'), ['action' => 'edit', $clipCollection->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Clip Collection'), ['action' => 'delete', $clipCollection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clipCollection->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Clip Collections'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Clip Collection'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clipCollections view content">
            <h3><?= h($clipCollection->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($clipCollection->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lib Collection') ?></th>
                    <td><?= $clipCollection->has('screen_collection') ? $this->Html->link($clipCollection->screen_collection->name, ['controller' => 'ScreenCollections', 'action' => 'view', $clipCollection->screen_collection->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($clipCollection->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Date') ?></th>
                    <td><?= h($clipCollection->start_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Date') ?></th>
                    <td><?= h($clipCollection->end_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($clipCollection->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($clipCollection->updated_at) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Clips') ?></h4>
                <?php if (!empty($clipCollection->clips)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th><?= __('Updated At') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($clipCollection->clips as $clips) : ?>
                        <tr>
                            <td><?= h($clips->id) ?></td>
                            <td><?= h($clips->name) ?></td>
                            <td><?= h($clips->created_at) ?></td>
                            <td><?= h($clips->updated_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Clips', 'action' => 'view', $clips->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Clips', 'action' => 'edit', $clips->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Clips', 'action' => 'delete', $clips->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clips->id)]) ?>
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
