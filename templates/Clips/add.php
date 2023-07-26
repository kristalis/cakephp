<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $clip
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Clips'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clips form content">
            <?= $this->Form->create($clip, ["enctype" => "multipart/form-data"]) ?>
            <fieldset>
                <legend><?= __('Add Book') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('clip_image', ['label' => 'Upload clip image(jpg, png, bmp)', 'type' => 'file', 'accept' => 'image/bmp,image/png,image/jpeg,image/jpg']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
