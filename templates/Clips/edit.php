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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $clip->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $clip->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Clips'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clips form content">
            <?= $this->Form->create($clip, ["enctype" => "multipart/form-data"]) ?>
            <fieldset>
                <legend><?= __('Edit Book') ?></legend>
                <?php
                    echo $this->Form->control('name');

                    if ($clip->clip_images) {
                        $img = $clip->clip_images[0];
                        echo 'Existing Image<br />';
                        echo $this->Html->image('/uploads/' . $img->filename, ['fullBase' => true, 'style' => 'max-width: 200px;max-height:200px;']);
                    }

                echo $this->Form->control('clip_image', ['label' => 'Select image (jpg, png)', 'type' => 'file']);
                if ($clip->clip_images) echo "<em>If you upload new image, existing image will be deleted.</em>";

                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
