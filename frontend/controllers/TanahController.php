<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Tanah;
use frontend\models\search\TanahSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use frontend\models\DetailTanah;
use yii\web\UploadedFile;
use yii\db\Query;

/**
 * TanahController implements the CRUD actions for Tanah model.
 */
class TanahController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all Tanah models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TanahSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tanah model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        $query = Tanah::find()->where(['id_tanah' => $id])->one();

        $query_detail = DetailTanah::find()->where(['tanah_id' => $query->id_tanah]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query_detail,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Tanah model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Tanah();

        if ($model->load(Yii::$app->request->post())) {
            $model->foto_pemilik = UploadedFile::getInstance($model, 'foto_pemilik');
            $model->foto_pemilik->saveAs('images/' . $model->foto_pemilik->baseName . '.' . $model->foto_pemilik->extension);
            $model->foto_pemilik = 'images/' . $model->foto_pemilik->baseName . '.' . $model->foto_pemilik->extension;
            $model->gambar_tanah = UploadedFile::getInstance($model, 'gambar_tanah');
            $model->gambar_tanah->saveAs('images/' . $model->gambar_tanah->baseName . '.' . $model->gambar_tanah->extension);
            $model->gambar_tanah = 'images/' . $model->gambar_tanah->baseName . '.' . $model->gambar_tanah->extension;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_tanah]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tanah model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_tanah]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tanah model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tanah model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Tanah the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Tanah::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
