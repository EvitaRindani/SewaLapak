<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Pemesanan;
use frontend\models\search\PemesananSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PemesananController implements the CRUD actions for Pemesanan model.
 */
class PemesananController extends Controller {

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
     * Lists all Pemesanan models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PemesananSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pemesanan model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pemesanan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Pemesanan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pemesanan]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pemesanan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pemesanan]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    // public function actionPesan($id) {
    //     if (Yii::$app->user->can('request')) {
    //         $model = new Pemesanan();
    //         $model->detail_id = $id;
    //         $model->user_id = Yii::$app->user->getId();
    //         date_default_timezone_set("Asia/Jakarta");
    //         $model->waktu_pemesanan = date("Y-m-d H:i:s");
    //         $model->waktu_penerimaan = '0000-00-00 00:00:00';
    //         $model->status = '0';
    //         $model->status_bayar = '0';
    //         $model->foto_transaksi = 'Foto transaksi belum ada';
    //         $model->save();
    //         return $this->redirect(['index']);
    //     } else {
    //         throw new NotFoundHttpException('The requested page does not exist.');
    //     }
    // }

     public function actionPesan($id) {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        } else {
            if (Yii::$app->user->can('request')) {
                $model = new Pemesanan();
                $model->detail_id = $id;

                $model->user_id = Yii::$app->user->getId();
                
                date_default_timezone_set("Asia/Jakarta");
                $model->waktu_pemesanan = date("Y-m-d H:i:s");
                $model->waktu_penerimaan = '0000-00-00 00:00:00';
                $model->status = '0';
                $model->status_bayar = '0';
                $model->foto_transaksi = 'Foto transaksi belum ada';
                $model->save();
                return $this->redirect(['index']);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
    }

    public function actionTerima($id) {
        if (Yii::$app->user->can('manage_request')) {
            $model = $this->findModel($id);
            date_default_timezone_set("Asia/Jakarta");
            $model->waktu_penerimaan = date("Y-m-d H:i:s");
            $model->status = "2";
            $model->save();
            return $this->redirect(['index']);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTolak($id) {
        if (Yii::$app->user->can('manage_request')) {
            $model = $this->findModel($id);
            date_default_timezone_set("Asia/Jakarta");
            $model->waktu_penerimaan = date("Y-m-d H:i:s");
            $model->status = "1";
            $model->save();
            return $this->redirect(['index']);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionBayar($id) {
        if (Yii::$app->user->can('view_request')) {
            $model = $this->findModel($id);
            $model->status_bayar = "2";
            $model->save();
            return $this->redirect(['index']);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCancel($id) {
        if (Yii::$app->user->can('view_request')) {
            $model = $this->findModel($id);
            $model->status_bayar = "1";
            $model->save();
            return $this->redirect(['index']);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUnggah($id) {
        if (Yii::$app->user->can('view_request')) {
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post())) {
                $model->foto_transaksi = UploadedFile::getInstance($model, 'foto_transaksi');
                $model->foto_transaksi->saveAs('images/' . $model->foto_transaksi->baseName . '.' . $model->foto_transaksi->extension);
                $model->foto_transaksi = 'images/' . $model->foto_transaksi->baseName . '.' . $model->foto_transaksi->extension;
                $model->save();
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Deletes an existing Pemesanan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pemesanan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Pemesanan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Pemesanan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
