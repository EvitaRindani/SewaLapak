<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\DetailTanahSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Tanahs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-tanah-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Detail Tanah', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_detail',
            'tanah_id',
            'tanggal_tersedia',
            'waktu_awal',
            'waktu_akhir',
        // 'harga',
        ],
    ]);
    ?>
</div>
