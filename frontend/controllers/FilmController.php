<?php

namespace frontend\controllers;

use yii\web\NotFoundHttpException;
use common\models\Film;


class FilmController extends AppController
{

    /**
     * @inheritdoc
     */
    public function actionView($id)
    {
        $modelFilm = Film::find()->where("id={$id}")->with('images')->one();

        return $this->render('view', [
            'modelFilm' => $modelFilm,
        ]);
    }

    /**
     * Finds the Film model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Film the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Film::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}