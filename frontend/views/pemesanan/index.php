<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Pemesanan;
use frontend\models\User;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\PemesananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Penyewaan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemesanan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <!-- <?= Html::a('Buat Detail Pemesanan', ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label' => 'Penyewa',
                'value' => function ($model, $key, $index, $column) {
                    $user = new User();
                    return $user->namaPengguna($model->user_id);
                }
            ],
            //'detail_id',
            'waktu_pemesanan',
            'waktu_penerimaan',
            'foto_transaksi',
            [
                'label' => 'Status',
                
                'value' => function($model, $key, $index, $column) {
                    $pemesanan = new Pemesanan();
                    return $pemesanan->changeValueStatus($model->status);
                }
            ],
            [
                'label' => 'Status Bayar',
                'value' => function($model, $key, $index, $column) {
                    $pemesanan = new Pemesanan();
                    return $pemesanan->changeValue($model->status_bayar);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'template' => '{terima} {tolak} {bayar} {cancel} {unggah}',
                'buttons' => [
                    'terima' => function($url, $model, $key) {
                        if (Yii::$app->user->can('manage_request')) {
                            if ($model->status == 0) {
                                return Html::a('Terima', ['pemesanan/terima', 'id' => $model->id_pemesanan], ['class' => 'btn btn-primary']);
                            }
                        }
                    },
                    'tolak' => function($url, $model, $key) {
                        if (Yii::$app->user->can('manage_request')) {
                            if ($model->status == 0) {
                                return Html::a('Tolak', ['pemesanan/tolak', 'id' => $model->id_pemesanan], ['class' => 'btn btn-danger']);
                            }
                        }
                    },
                    'bayar' => function($url, $model, $key) {
                        if (Yii::$app->user->can('view_request')) {
                            if ($model->status_bayar == 0 && $model->status == 2) {
                                if (Yii::$app->user->id!=1){
                                    return Html::a('Bayar', ['pemesanan/bayar', 'id' => $model->id_pemesanan], ['class' => 'btn btn-primary']);
                                }else{

                                }
                            }
                        }
                    },
                    'cancel' => function($url, $model, $key) {
                        if (Yii::$app->user->can('view_request')) {
                            if ($model->status_bayar == 0 && $model->status == 2) {
                                if (Yii::$app->user->id!=1){
                                    return Html::a('Cancel', ['pemesanan/cancel', 'id' => $model->id_pemesanan], ['class' => 'btn btn-danger']);
                                }else{

                                }
                            }
                        }
                    },
                    'unggah' => function($url, $model, $key) {
                        if (Yii::$app->user->can('view_request')) {

                            if ($model->status_bayar == 2 ) {

                                if ($model->foto_transaksi =='Foto transaksi belum ada'){
                                    return Html::a('Unggah Foto Transaksi', ['pemesanan/unggah', 'id' => $model->id_pemesanan], ['class' => 'btn btn-primary']);
                                }elseif ($model->foto_transaksi!='Foto transaksi belum ada'){
                                    return "<h4><div><center><span class='label label-success'>Telah Dipesan</span></center></div></h4>";
                                }
                            }
                        }
                    }
                ]
            ]
        ],
    ]);
    ?>

    <h4><b>Langkah-langkah pembayaran :</b></h4>
    <p><h5>1. Mentransfer uang sewa sesuai dengan harga yang tertera ke bank, dengan nomor rekening : <b>08322646304635646 (BRI)</b>.</h5></p>
    <p><h5>2. Mengklik tombol "Bayar".</h5></p>
    <p><h5>3. Mengklik tombol "Unggah Foto Transaksi" untuk mengunggah bukti transfer/resi pembayaran, sebagai bukti yang sah.</h5></p>
    <p><h5></h5></p>
    <p><h5></h5></p>
    <p><h5></h5></p>
</div>
