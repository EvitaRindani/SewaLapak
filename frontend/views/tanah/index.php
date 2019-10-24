<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\TanahSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sewa Lapak';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tanah-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <table><td style="width: 300px;"> 
    <?= $this->render('_search', ['model' => $searchModel]); ?></td>


    <td style="color: rgba(255,255,255,0);">...<p style="color: rgba(255,255,255,0);">...<?= Html::submitButton('Cari Tanah di Kota', ['class' => 'btn btn-primary']) ?></p></td>
        </table>
    <?php  if (Yii::$app->user->id==1) { ?>
        <p><?= Html::a('Buat Lapak Baru', ['create'], ['class' => 'btn btn-success']) ?></p>
        <?php } else {} ?>
        



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kabupaten',
            //'gambar_tanah',
            //'id_tanah',
            //'nama_pemilik',
            //'foto_pemilik',
            //'no_hp_pemilik',
            //'no_rekening_pemilik',
            'alamat_tanah',
            'kota',
            [
                'header' => '<center>Detail</center>',
                'format'    => 'raw',
                'value' => function ($model){
                    return '<div>'.'<center>'.Html::a('Selengkapnya',[
                        'tanah/view','id'=>$model->id_tanah],
                        ['class' => 'btn btn-success']).'</center>'.'</div>';
                }
            ],
        ],
    ]);
    ?>
</div>
