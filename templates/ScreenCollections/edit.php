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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $screenCollection->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $screenCollection->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Lib Collections'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="screenCollections form content">
            <?= $this->Form->create($screenCollection) ?>
            <fieldset>
                <legend><?= __('Edit Lib Collection') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('screen_count');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
