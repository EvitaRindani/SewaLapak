<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pemesanan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemesanan-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'waktu_pemesanan')->textInput() ?>

    <?= $form->field($model, 'waktu_penerimaan')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'status_bayar')->textInput() ?>

    <?= $form->field($model, 'foto_transaksi')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::submitButton('Unggah Foto Bukti Transaksi', ['btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
