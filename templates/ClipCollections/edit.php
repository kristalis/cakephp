<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClipCollection $clipCollection
 * @var string[]|\Cake\Collection\CollectionInterface $screenCollections
 * @var string[]|\Cake\Collection\CollectionInterface $clips
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $clipCollection->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $clipCollection->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Clip Collections'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clipCollections form content">
            <?= $this->Form->create($clipCollection) ?>
            <fieldset>
                <legend><?= __('Edit Clip Collection') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('screen_collection_id', ['options' => $screenCollections, 'empty' => 'Select One', 'required' => true]);
                    echo $this->Form->control('start_date');
                    echo $this->Form->control('end_date');
                    echo $this->Form->control('clips._ids', ['options' => $clips, 'style' => 'height: 100px;', 'label' => 'Clips (select multiple)']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
