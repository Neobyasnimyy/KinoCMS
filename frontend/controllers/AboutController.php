<?php


namespace frontend\controllers;


use common\models\Article;

class AboutController extends AppController
{

    public function actionArticles()
    {
        $modelArticles = Article::find()->where('article_is_active =1')->with('images')->all();

        return $this->render('articles', [
            'modelArticles' => $modelArticles,
        ]);
    }
}