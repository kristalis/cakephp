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
            <?= $this->Html->link(__('Edit Book'), ['action' => 'edit', $clip->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Book'), ['action' => 'delete', $clip->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clip->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Clips'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Book'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clips view content">
            <h3><?= h($clip->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($clip->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($clip->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($clip->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($clip->updated_at) ?></td>
                </tr>
                <tr>
                    <td><?php echo __("Video"); ?></td>
                    <td>
                        <?php
                        if($clip->video){
                            ?>
                            <video src="/uploads/<?php echo $clip->video; ?>" style="max-width: 100%" controls></video>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Image') ?></th>
                    <td>
                        <?php
                        if($clip->clip_images){
                            $img = $clip->clip_images[0];
                            echo '<a href="/uploads/'.$img->filename.'">'.$this->Html->image('/uploads/'.$img->filename, ['fullBase' => true, 'style' => 'max-width: 200px;max-height:200px;']).'</a>';
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
