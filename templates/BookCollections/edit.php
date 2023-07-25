<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookCollection $bookCollection
 * @var string[]|\Cake\Collection\CollectionInterface $libCollections
 * @var string[]|\Cake\Collection\CollectionInterface $books
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $bookCollection->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $bookCollection->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Book Collections'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bookCollections form content">
            <?= $this->Form->create($bookCollection) ?>
            <fieldset>
                <legend><?= __('Edit Book Collection') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('lib_collection_id', ['options' => $libCollections, 'empty' => 'Select One', 'required' => true]);
                    echo $this->Form->control('start_date');
                    echo $this->Form->control('end_date');
                    echo $this->Form->control('books._ids', ['options' => $books, 'style' => 'height: 100px;', 'label' => 'Books (select multiple)']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
