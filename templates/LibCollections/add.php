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
            <?= $this->Html->link(__('List Lib Collections'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="libCollections form content">
            <?= $this->Form->create($libCollection) ?>
            <fieldset>
                <legend><?= __('Add Lib Collection') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('lib_count');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
