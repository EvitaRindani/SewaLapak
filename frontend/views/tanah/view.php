<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use frontend\models\Pemesanan;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tanah */

$this->title = 'Lapak milik ' . $model->nama_pemilik;
$this->params['breadcrumbs'][] = ['label' => 'Sewa Lapak', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tanah-view">
<section class="content">
          <div class="row">
            <div class="col-md-12">
             <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">

    <?= Html::encode($this->title) ?></h3>

    <p><?php  if (Yii::$app->user->id==1) { ?>
        <?= Html::a('Update', ['update', 'id' => $model->id_tanah], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id_tanah], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
        <?php } else{} ?>
    </p></div>
    <div class="box-body">
                <div class="col-md-3"> 
    <img src="<?= Yii::$app->request->baseUrl . '/' . $model->foto_pemilik ?>" width="250" height="225"    > 
    </div>
    <div class="col-md-9">



    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_pemilik',
            'no_hp_pemilik',
            'alamat_tanah',
            'kota',
            'kabupaten',
            'no_rekening_pemilik',
        ],
    ])
    ?>



    
    </div></div></div></div></div></section></div>
    <h4 style="text-align: center">Gambar Lapak :</h4>
    <p align="center"><img src="<?= Yii::$app->request->baseUrl . '/' . $model->gambar_tanah ?>" width="250" height="225" ></p>

    <?php if (Yii::$app->user->id==1) {?>
    <?=  '<div>'.'<center>'.Html::a('Tambah Jadwal Lapak',['/detail-tanah/create/'],['class' => 'btn btn-primary']).'</center>'.'</div>' ?>
    <?php }else{} ?>
    <br>



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'tanggal_tersedia',
            'waktu_awal',
            'waktu_akhir',
            'harga',
            [
                'header' => '<center>Detail</center>',
                'format'    => 'raw',
                'value' => function ($model){
                    return '<div>'.'<center>'.Html::a('Selengkapnya',[
                        'detail-tanah/view','id'=>$model->id_detail],
                        ['class' => 'btn btn-success']).'</center>'.'</div>';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '<center>Aksi</center>',
                'template' => '{pesan}',
                'buttons' => [
                    'pesan' => function($url, $model, $key) {
                        date_default_timezone_set("Asia/Jakarta");
                        $last_date = $model->tanggal_tersedia . ' ' . $model->waktu_akhir;
                        $first_date = $model->tanggal_tersedia . ' ' . $model->waktu_awal;
                        $current_date = date("Y-m-d H:i:s");
                        // print_r($last_date);
                        // die;

                        $pemesanan = Pemesanan::find()->where(['detail_id'=>$model->id_detail,'status'=>0])->one();

                        if ($pemesanan != null) {
                            return "<h4><div><center><span class='label label-default'>Sudah Dipesan</span></center></div></h4>";
                        }

                        else if ($current_date<=$first_date && $current_date<= $last_date){

                            return '<div>'.'<center>'.Html::a('Pesan',['pemesanan/pesan','id'=>$model->id_detail],['class'=>'btn btn-primary']).'</center>'.'</div>';
                        }
                    }
                ]
            ],



        ],
    ]);
    ?>
    
</div>
