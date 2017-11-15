<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Film */

$this->title =  $model->film_name;
//$this->params['breadcrumbs'][] = ['label' => 'Films', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="film-update">

    <?= $this->render('_form', [
        'model' => $model,
        'uploadGalleryImagesFilm'=>$uploadGalleryImagesFilm,
        'modelFilmImages'=>$modelFilmImages,
    ]) ?>

</div>
