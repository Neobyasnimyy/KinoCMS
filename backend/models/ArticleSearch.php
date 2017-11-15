<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `common\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'article_is_active'], 'integer'],
            [['article_title', 'article_data', 'article_description', 'article_video_url', 'article_seo_url', 'article_seo_title', 'article_seo_keywords', 'article_seo_description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Article::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'article_data' => $this->article_data,
            'article_is_active' => $this->article_is_active,
        ]);

        $query->andFilterWhere(['like', 'article_title', $this->article_title])
            ->andFilterWhere(['like', 'article_description', $this->article_description])
            ->andFilterWhere(['like', 'article_video_url', $this->article_video_url])
            ->andFilterWhere(['like', 'article_seo_url', $this->article_seo_url])
            ->andFilterWhere(['like', 'article_seo_title', $this->article_seo_title])
            ->andFilterWhere(['like', 'article_seo_keywords', $this->article_seo_keywords])
            ->andFilterWhere(['like', 'article_seo_description', $this->article_seo_description]);

        return $dataProvider;
    }
}
