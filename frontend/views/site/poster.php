<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="poster">
    <div class="row">
        <?php if (!empty($currentFilm)): ?>
            <?php foreach ($currentFilm as $film):?>
                <?php if(!empty($film['film_name'])):?>
                    <div class="col-md-3">
                        <p><?php echo Html::img(Yii::getAlias('@getImages') . "/film/{$film['id']}/{$film['film_image_name']}", ['class' => 'img-responsive']); ?></p>
                        <p><a href="<?php echo Url::toRoute(['film/view','id'=>$film['id']])?>"><?php echo $film['film_name']?></a></p>
                    </div>
                <?php endif?>
            <?php endforeach;?>
        <?php endif; ?>
    </div>
</div>
