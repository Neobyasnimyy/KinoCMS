<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Article;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список новостей';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <p class="text-right">
        <?= Html::a('Новая Новость', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{items}\n{pager}",
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'article_title',
            [
                'attribute' => 'article_data',
                'contentOptions' => [
                    'style' => 'min-width:100px;'
                ],
                'filter' => DatePicker::widget([
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'model' => $searchModel,
                    'attribute' => 'article_data',
                    'removeButton' => false,
                    'language' => 'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'minViewMode' => 'months',
                        'todayHighlight' => true,// подсвечивает сегодняшнюю дату
                        'startView' => 1, // сначало выбираем год => 2
                        'format' => 'yyyy-mm',
                        'clearBtn' => true,
                    ],
                ]),

            ],
            [
                'attribute' => 'article_is_active',
                'filter' =>Article::getStatusList(),
                'value'=>'status',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>


</div>
