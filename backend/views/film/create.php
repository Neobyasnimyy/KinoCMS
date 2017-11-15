<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Film */

$this->title = 'Новый Фильм';
//$this->params['breadcrumbs'][] = ['label' => 'Films', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-create">


    <?= $this->render('_form', [
        'model' => $model,
        'uploadGalleryImagesFilm'=>$uploadGalleryImagesFilm,
    ]) ?>

</div>
