<?php

namespace coommon\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $article_title
 * @property string $article_data
 * @property string $article_description
 * @property string $article_video_url
 * @property integer $article_is_active
 * @property string $article_seo_url
 * @property string $article_seo_title
 * @property string $article_seo_keywords
 * @property string $article_seo_description
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_title'], 'required'],
            [['article_data'], 'safe'],
            [['article_description', 'article_seo_description'], 'string'],
            [['article_is_active'], 'integer'],
            [['article_title', 'article_video_url', 'article_seo_url', 'article_seo_title', 'article_seo_keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_title' => 'Article Title',
            'article_data' => 'Article Data',
            'article_description' => 'Article Description',
            'article_video_url' => 'Article Video Url',
            'article_is_active' => 'Article Is Active',
            'article_seo_url' => 'Article Seo Url',
            'article_seo_title' => 'Article Seo Title',
            'article_seo_keywords' => 'Article Seo Keywords',
            'article_seo_description' => 'Article Seo Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(ArticleImages::className(), ['article_id' => 'id']);
    }
}
