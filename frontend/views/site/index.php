<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'KinoCMS';

?>
<div class="site-index">

    <p class="text-center"><b>Смотрите сегодня, <?php echo date("d").' '.Yii::$app->mycomponent->getRuMouth(date('m'));?></b></p>
    <div class="row">
        <?php foreach ($currentFilm as $film):?>
            <?php if(!empty($film['film_name'])):?>
                <div class="col-md-3">
                    <p><?php echo Html::img(Yii::getAlias('@getImages') . "/film/{$film['id']}/{$film['film_image_name']}", ['class' => 'img-responsive']); ?></p>
                    <p><a href="<?php echo Url::toRoute(['film/view','id'=>$film['id']])?>"><?php echo $film['film_name']?></a></p>
                </div>
            <?php endif?>
        <?php endforeach ?>
    </div>
    <p class="text-center"><b>Смотрите скоро</b></p>
    <div class="row">
        <?php foreach ($soonFilm as $film):?>
            <?php if(!empty($film['film_name'])):?>
                <div class="col-md-3">
                    <p><?php echo Html::img(Yii::getAlias('@getImages') . "/film/{$film['id']}/{$film['film_image_name']}", ['class' => 'img-responsive']); ?></p>
                    <p><a href="<?php echo Url::toRoute(['film/view','id'=>$film['id']])?>"><?php echo $film['film_name']?></a></p>
                </div>
            <?php endif?>
        <?php endforeach ?>
    </div>
</div>
