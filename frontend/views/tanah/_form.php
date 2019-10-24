<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tanah */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tanah-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'nama_pemilik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto_pemilik')->fileInput() ?>

    <?= $form->field($model, 'no_hp_pemilik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_rekening_pemilik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_tanah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gambar_tanah')->fileInput() ?>

    <?= $form->field($model, 'kota')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kabupaten')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
