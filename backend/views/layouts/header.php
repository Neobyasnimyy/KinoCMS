<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">KinoCMS</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">


                <li>
                    <a href="/" data-toggle="control-sidebar"><i class="fa fa-user" aria-hidden="true"></i> Мой кабинет</a>
                </li>
                <li>
                        <?php echo Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                '<i class="fa fa-power-off " aria-hidden="true" style="color: white"></i>',
                                ['class'=>'btn btn-link logout']
                            )
                            . Html::endForm() ?>

<!--                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-power-off " aria-hidden="true"></i></a>-->
                </li>
            </ul>
        </div>
    </nav>
</header>
