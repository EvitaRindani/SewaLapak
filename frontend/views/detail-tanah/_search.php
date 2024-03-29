<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\DetailTanahSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-tanah-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_detail') ?>

    <?= $form->field($model, 'tanah_id') ?>

    <?= $form->field($model, 'tanggal_tersedia') ?>

    <?= $form->field($model, 'waktu_awal') ?>

    <?= $form->field($model, 'waktu_akhir') ?>

    <?php // echo $form->field($model, 'harga') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
