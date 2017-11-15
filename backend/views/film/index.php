<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FilmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список фильмов';
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="film-index">
    <p class="text-right">
        <?= Html::a('Новый Фильм', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{items}\n{pager}",
        'columns' => [

            'film_name',
            [
                'attribute' => 'film_data',
                'contentOptions' => [
                    'style' => 'min-width:100px;'
                ],
                'filter' => DatePicker::widget([
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'model' => $searchModel,
                    'attribute' => 'film_data',
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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
