<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pemesanan */

$this->title = 'Detail Pemesanan: ' . $model->id_pemesanan;
$this->params['breadcrumbs'][] = ['label' => 'Detail Pemesanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pemesanan, 'url' => ['view', 'id' => $model->id_pemesanan]];
$this->params['breadcrumbs'][] = 'Unggah Foto Transaksi';
?>
<div class="pemesanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
