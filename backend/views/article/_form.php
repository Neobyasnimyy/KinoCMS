<?php
/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;
use kartik\file\FileInput;

$this->registerCssFile("/css/switcher.css");
$this->registerCss('.gallery-images >div{ min-height: 120px;}');
$this->registerJsFile('/js/article/form.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);


$fieldConfig1 = [
    'template' => '<div class="col-md-4">{label}</div><div class="col-md-8">{input}{error}</div>',
];


$fieldConfig3 = [
    'template' => '<div class="col-md-1 text-center">{label}</div><div class="col-md-11">{input}{error}</div>',
//    'labelOptions' => ['class' => 'col-sm-2 control-label'],
];
$fieldConfig4 = [
    'template' => '<div class="col-md-2">{label}</div><div class="col-md-10">{input}{error}</div>',
];
$fieldConfig5 = [
    'template' => '<div class="col-md-2 text-right">{label}</div><div class="col-md-10">{input}{error}</div>',
];
$fieldConfig6 = [
    'template' => '<span class="button-checkbox"><button type="button" class="btn" data-color="danger">Удалить</button>{input}{error}</span>',
];
?>

<div class="article-form ">

    <?php $form = ActiveForm::begin(); ?>

    <div class="text-right">
        <div id="toggles">
            <input type="checkbox" name="checkbox1" id="checkbox1"
                   class="ios-toggle" <?php echo ($model->isNewRecord or $model->article_is_active == 1) ? 'checked' : '' ?>/>
            <label for="checkbox1" class="checkbox-label" data-off="ВЫКЛ" data-on="ВКЛ"></label>
            <?php
            echo $form->field($model, 'article_is_active')->checkbox()->label(false)->hiddenInput();
            ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <?php echo $form->field($model, 'article_title', $fieldConfig1)
                ->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('article_title')]);
            ?>
        </div>
        <div class="col-md-6">
            <?php
            if (empty($model->article_data)) {
                $model->article_data = date('Y-m-d');
            }
            echo $form->field($model, 'article_data', $fieldConfig1)->widget(DatePicker::className(), [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
//                'options' => ['placeholder' => 'Ввод даты ...'],
                'value' => date("yyyy-mm-dd", (integer)$model->article_data),
                'removeButton' => false,
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                    'todayHighlight' => true,// подсвечивает сегодняшнюю дату
//            'startView'=>2, // сначало выбираем год => 2
                    'weekStart' => 1, //неделя начинается с понедельника
//            'startDate' => '01.05.2015 00:00', //самая ранняя возможная дата
                    'todayBtn' => 'linked', //снизу кнопка "сегодня"
                ]

            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'article_description', $fieldConfig3)->textarea(['rows' => 6, 'placeholder' => 'текст']) ?>
    </div>

    <div class="row">
        <div class="col-md-2 ">
            <b><?php echo $model->getAttributeLabel('article_image_name') ?></b>
        </div>
        <?php if (isset($model->article_image_name) && file_exists(Yii::getAlias('@upImages') . "/article/{$model->id}/{$model->article_image_name}")): ?>
            <div class="col-md-2 col-xs-4">
                <?php echo Html::img(Yii::getAlias('@getImages') . "/article/{$model->id}/{$model->article_image_name}", ['class' => 'img-responsive']); ?>
                <br>
            </div>
            <div class="col-md-2">
                <?php $pluginOptions = [
                    'allowedFileExtensions' => ['jpg', 'gif', 'png', 'bmp'],
                    'overwriteInitial' => true, // перезаписывает данные которые мы ему передали при инициализации
                    'showPreview' => false,
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'browseLabel' => 'Заменить Фото',
                    'browseIcon' => '',
                ];

                echo $form->field($model, 'image')->widget(FileInput::classname(), [
                    'language' => 'ru',
                    'options' => [
                        'accept' => 'image/*',
//                    'required'=>$modelArticle->isNewRecord ? 'required' : false,
                    ],
                    'pluginOptions' => $pluginOptions
                ])->label(false); ?>
            </div>
            <div class="col-md-2">
                <?php
                echo $form->field($model, 'del_img', $fieldConfig6)
                    ->input('checkbox', ['class' => 'hidden', 'value' => true])
                ?>

            </div>
        <?php else: ?>
            <div class="col-md-4">
                <!--            --><?php //echo $form->field($uploadImageArticle, 'image')->fileInput()->label(false) ?>
                <?php $pluginOptions = [
                    'allowedFileExtensions' => ['jpg', 'gif', 'png', 'bmp'],
                    'overwriteInitial' => true, // перезаписывает данные которые мы ему передали при инициализации
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => false,
                    'showUpload' => false,
                    'browseLabel' => 'Загрузить Фото',
                    'browseIcon' => '',
                ];

                echo $form->field($model, 'image')->label('Обложка')->widget(FileInput::classname(), [
                    'language' => 'ru',
                    'options' => [
                        'multiple' => true,
                        'accept' => 'image/*',
//                    'required'=>$modelArticle->isNewRecord ? 'required' : false,
                    ],
                    'pluginOptions' => $pluginOptions
                ])->label(false); ?>
            </div>
        <?php endif; ?>
    </div>

    <p><b>Галерея картинок</b></p>
    <div class="row ">

        <div class="col-md-2">
            <b>Размер: 1000x190</b>
        </div>
        <div class="col-md-10 gallery-images">
            <div class="col-md-2">
                <?php $pluginOptions = [
                    'allowedFileExtensions' => ['jpg', 'gif', 'png', 'bmp'],
                    'overwriteInitial' => true, // перезаписывает данные которые мы ему передали при инициализации
                    'showPreview' => false,
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'browseLabel' => 'Добавить Фото',
                    'browseIcon' => '',
                ];

                echo $form->field($uploadGalleryImagesArticle, 'images[]')->widget(FileInput::classname(), [
                    'language' => 'ru',
                    'options' => [
                        'accept' => 'image/*',
                        'multiple' => true,
//                    'required'=>false,
                    ],
                    'pluginOptions' => $pluginOptions
                ])->label(false); ?>
            </div>
            <?php if (!empty($modelArticleImages)): ?>
                <?php foreach ($modelArticleImages as $image): ?>
                    <div class="col-md-2 col-xs-4" >
                        <?php echo Html::img(Yii::getAlias('@getImages') . "/article/{$image->parent_id}/{$image->name}", ['class' => 'img-responsive']); ?>
                        <p><?php
                            echo $form->field($image, 'del', $fieldConfig6)
                                ->input('checkbox', ['name'=>"ArticleImages[del][$image->id]",'class' => 'hidden', 'value' => true])
                            ?></p>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>


    </div>

    <div class="row">
        <?php echo $form->field($model, 'article_video_url', $fieldConfig4)
            ->textInput(['maxlength' => true])
            ->input('text', ['placeholder' => "Сcылка на видео в youtube"])
        ?>
    </div>

    <br>
    <div class="row">
        <div class="col-md-2 ">
            <b>SEO Блок</b>
        </div>
        <div class="col-md-8">
            <?php echo $form->field($model, 'article_seo_url', $fieldConfig5)
                ->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('article_seo_url')]);
            ?>

            <?php echo $form->field($model, 'article_seo_title', $fieldConfig5)
                ->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('article_seo_title')]);
            ?>

            <?php echo $form->field($model, 'article_seo_keywords', $fieldConfig5)
                ->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('article_seo_keywords')]);
            ?>

            <?php echo $form->field($model, 'article_seo_description', $fieldConfig5)
                ->textarea(['rows' => 6, 'placeholder' => $model->getAttributeLabel('article_seo_description')])
            ?>
        </div>

    </div>


    <div class="form-group text-center">
        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
