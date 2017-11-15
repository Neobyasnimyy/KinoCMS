<?php

namespace backend\controllers;

use backend\models\UploadImages;
use common\models\ArticleImages;
use Yii;
use common\models\Article;
use backend\models\ArticleSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class ArticleController extends AppController
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
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        $uploadGalleryImagesArticle = new UploadImages();
        $error = false;

        if ($model->load(Yii::$app->request->post()) ) {

            $model->image = UploadedFile::getInstance($model, 'image');

            if($model->validate() && $model->save()){
                $uploadGalleryImagesArticle->images = UploadedFile::getInstances($uploadGalleryImagesArticle, 'images');

                if ($uploadGalleryImagesArticle->images != null) {
                    $uploadGalleryImagesArticle->parent_id=$model->id;
                    $uploadGalleryImagesArticle->dirName='article';
                    if($uploadGalleryImagesArticle->upload()){
                        foreach ($uploadGalleryImagesArticle->images as $item){
                            $modelArticleImages= new ArticleImages();
                            $modelArticleImages->parent_id=$model->id;
                            $modelArticleImages->name=$item->name;
                            $modelArticleImages->save();
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
            'uploadGalleryImagesArticle' => $uploadGalleryImagesArticle,
        ]);

    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate(int $id)
    {

        $model = $this->findModel($id);
        $modelArticleImages=ArticleImages::find()->where('parent_id='.$id)->all();
        $uploadGalleryImagesArticle = new UploadImages();
        $error = false;


        if ($model->load(Yii::$app->request->post())) {
            if(!empty($delImages = Yii::$app->request->post('ArticleImages')['del'])){
                foreach ($delImages as $key => $value){
                    ArticleImages::findOne($key)->delete();
                }
            }
            $model->image = UploadedFile::getInstance($model, 'image');

            if($model->validate() && $model->save()){
                $uploadGalleryImagesArticle->images = UploadedFile::getInstances($uploadGalleryImagesArticle, 'images');

                if ($uploadGalleryImagesArticle->images != null) {
                    $uploadGalleryImagesArticle->parent_id=$model->id;
                    $uploadGalleryImagesArticle->dirName='article';
                    if($uploadGalleryImagesArticle->upload()){
                        foreach ($uploadGalleryImagesArticle->images as $item){
                            $modelArticleImages= new ArticleImages();
                            $modelArticleImages->parent_id=$model->id;
                            $modelArticleImages->name=$item->name;
                            $modelArticleImages->save();
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
            'uploadGalleryImagesArticle' => $uploadGalleryImagesArticle,
            'modelArticleImages'=>$modelArticleImages,
        ]);

    }

    /**
     * Deletes an existing Article model.
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
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
