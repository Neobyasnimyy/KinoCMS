<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Film;

/**
 * FilmSearch represents the model behind the search form about `common\models\Film`.
 */
class FilmSearch extends Film
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['film_name', 'film_description', 'film_image_name',
                'film_url_trailer', 'film_seo_url', 'film_seo_title',
                'film_seo_keywords', 'film_seo_description'], 'safe'],
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
        $query = Film::find();

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
//            'film_is_active' => $this->film_is_active,
        ]);

        $query->andFilterWhere(['like', 'film_name', $this->film_name])
            ->andFilterWhere(['like', 'film_description', $this->film_description])
            ->andFilterWhere(['like', 'film_image_name', $this->film_image_name])
            ->andFilterWhere(['like', 'film_url_trailer', $this->film_url_trailer])
            ->andFilterWhere(['like', 'film_seo_url', $this->film_seo_url])
            ->andFilterWhere(['like', 'film_seo_title', $this->film_seo_title])
            ->andFilterWhere(['like', 'film_seo_keywords', $this->film_seo_keywords])
            ->andFilterWhere(['like', 'film_seo_description', $this->film_seo_description]);

        return $dataProvider;
    }
}
