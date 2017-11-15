<?php

namespace backend\controllers;

use backend\models\UploadImages;
use common\models\FilmImages;
use Yii;
use common\models\Film;
use backend\models\FilmSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;



class FilmController extends AppController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Film models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FilmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new Film model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Film();
        $uploadGalleryImagesFilm = new UploadImages();
        $error = false;

        if ($model->load(Yii::$app->request->post()) ) {

            $model->image = UploadedFile::getInstance($model, 'image');

            if($model->validate() && $model->save()){
                $uploadGalleryImagesFilm->images = UploadedFile::getInstances($uploadGalleryImagesFilm, 'images');

                if ($uploadGalleryImagesFilm->images != null) {
                    $uploadGalleryImagesFilm->parent_id=$model->id;
                    $uploadGalleryImagesFilm->dirName='film';
                    if($uploadGalleryImagesFilm->upload()){
                        foreach ($uploadGalleryImagesFilm->images as $item){
                            $modelArticleFilm= new FilmImages();
                            $modelArticleFilm->parent_id=$model->id;
                            $modelArticleFilm->name=$item->name;
                            $modelArticleFilm->save();
                        }
                    }else{
                        $error= true;
                    }
                }

                if ($error==false){
                    Yii::$app->session->setFlash('success', 'Данные приняты');
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'uploadGalleryImagesFilm' => $uploadGalleryImagesFilm,
        ]);
    }

    /**
     * Updates an existing Film model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate( int $id)
    {
        $model = $this->findModel($id);
        $modelFilmImages=FilmImages::find()->where('parent_id='.$id)->all();
        $uploadGalleryImagesFilm = new UploadImages();
        $error = false;


        if ($model->load(Yii::$app->request->post())) {
            if(!empty($delImages = Yii::$app->request->post('FilmImages')['del'])){
                foreach ($delImages as $key => $value){
                    FilmImages::findOne($key)->delete();
                }
            }
            $model->image = UploadedFile::getInstance($model, 'image');

            if($model->validate() && $model->save()){
                $uploadGalleryImagesFilm->images = UploadedFile::getInstances($uploadGalleryImagesFilm, 'images');

                if ($uploadGalleryImagesFilm->images != null) {
                    $uploadGalleryImagesFilm->parent_id=$model->id;
                    $uploadGalleryImagesFilm->dirName='film';
                    if($uploadGalleryImagesFilm->upload()){
                        foreach ($uploadGalleryImagesFilm->images as $item){
                            $modelFilmImages= new FilmImages();
                            $modelFilmImages->parent_id=$model->id;
                            $modelFilmImages->name=$item->name;
                            $modelFilmImages->save();
                        }
                    }else{
                        $error= true;
                    }
                }

                if ($error==false){
                    Yii::$app->session->setFlash('success', 'Данные приняты');
                    return $this->redirect(['index']);
                }
            }

        }

        return $this->render('update', [
            'model' => $model,
            'uploadGalleryImagesFilm' => $uploadGalleryImagesFilm,
            'modelFilmImages'=>$modelFilmImages,
        ]);
    }

    /**
     * Deletes an existing Film model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
