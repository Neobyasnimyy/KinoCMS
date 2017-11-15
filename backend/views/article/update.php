<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title =  $model->article_title;
//$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="article-update">


    <?= $this->render('_form', [
        'model' => $model,
        'uploadGalleryImagesArticle'=>$uploadGalleryImagesArticle,
        'modelArticleImages'=>$modelArticleImages,
    ]) ?>

</div>
