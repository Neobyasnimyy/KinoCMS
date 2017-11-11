<?php

namespace coommon\models;

use Yii;

/**
 * This is the model class for table "film".
 *
 * @property integer $id
 * @property string $film_name
 * @property string $film_description
 * @property string $film_url_trailer
 * @property integer $film_type
 * @property integer $film_is_active
 * @property string $film_seo_url
 * @property string $film_seo_title
 * @property string $film_seo_keywords
 * @property string $film_seo_description
 */
class Film extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'film';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['film_description', 'film_seo_description'], 'string'],
            [['film_type', 'film_is_active'], 'integer'],
            [['film_name', 'film_url_trailer','film_image_name', 'film_seo_url', 'film_seo_title', 'film_seo_keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'film_name' => 'Название фильма',
            'film_description' => 'Описание',
            'film_image_name'=>'Главная картинка',
            'film_url_trailer' => 'Ссылка на трейлер',
            'film_type' => 'Тип кино',
            'film_is_active' => 'Статус',
            'film_seo_url' => 'Url',
            'film_seo_title' => 'Title',
            'film_seo_keywords' => 'Keywords',
            'film_seo_description' => 'Description',
        ];
    }
}
