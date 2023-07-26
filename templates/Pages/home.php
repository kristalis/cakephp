<?php
echo $this->Html->css(['jquery-ui']);
echo $this->Html->script(['jquery-3.6.0', 'jquery-ui']);

/** @var iterable<\App\Model\Entity\ScreenCollection> $data */

?>
<div id="tabs">
    <ul>
        <?php
        foreach($data as $datum){
            ?>
            <li><a href="#tabs-<?= $this->Number->format($datum->id)?>"><?= h($datum->get('label'))?></a></li>
            <?php
        }
        ?>
    </ul>
    <?php
    foreach($data as $datum){
        ?>
        <div id="tabs-<?= $this->Number->format($datum->id)?>">
            <div class="table-responsive">
                <table>
                    <thead>
                    <tr>
                        <th>Clips</th>
                        <th>Collection Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($datum->clip_collections as $clip_collection){
                        ?>
                        <tr>
                            <td>
                                <?php
                                foreach($clip_collection->clips as $clip){
                                    if($clip->clip_images){
                                        $img = $clip->clip_images[0];
                                        $img_src = $this->Url->build('/uploads/'.$img->filename);
                                        $img_tag = $this->Html->image('/uploads/'.$img->filename, ['fullBase' => true, 'style' => 'max-width: 50px;max-height:50px;']);
                                        echo $this->Html->link($img_tag, $img_src, ['target' => '_blank', 'escape' => false]);;
                                    }
                                    //echo h($clip->name)."<br />";
                                }
                                ?>
                            </td>
                            <td><?= h($clip_collection->name)?></td>
                            <td><?= h($clip_collection->start_date) ?></td>
                            <td><?= h($clip_collection->end_date) ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<script>
    $( function() {
        $( "#tabs" ).tabs();
    } );
</script>
