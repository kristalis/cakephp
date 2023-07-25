<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $book->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $book->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Books'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="books form content">
            <?= $this->Form->create($book, ["enctype" => "multipart/form-data"]) ?>
            <fieldset>
                <legend><?= __('Edit Book') ?></legend>
                <?php
                    echo $this->Form->control('name');

                    if ($book->book_images) {
                        $img = $book->book_images[0];
                        echo 'Existing Image<br />';
                        echo $this->Html->image('/uploads/' . $img->filename, ['fullBase' => true, 'style' => 'max-width: 200px;max-height:200px;']);
                    }

                echo $this->Form->control('book_image', ['label' => 'Select image (jpg, png)', 'type' => 'file']);
                if ($book->book_images) echo "<em>If you upload new image, existing image will be deleted.</em>";

                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
