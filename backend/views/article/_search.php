<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'article_title') ?>

    <?= $form->field($model, 'article_data') ?>

    <?= $form->field($model, 'article_description') ?>

    <?= $form->field($model, 'article_video_url') ?>

    <?php // echo $form->field($model, 'article_is_active') ?>

    <?php // echo $form->field($model, 'article_seo_url') ?>

    <?php // echo $form->field($model, 'article_seo_title') ?>

    <?php // echo $form->field($model, 'article_seo_keywords') ?>

    <?php // echo $form->field($model, 'article_seo_description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
