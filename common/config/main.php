<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@getImages'=>'http://kinocms.loc/uploads/images'
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'mycomponent' => [
            'class' => 'common\components\MyComponent'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
