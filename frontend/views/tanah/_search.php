<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\TanahSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tanah-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!-- <?= $form->field($model, 'id_tanah') ?>

    <?= $form->field($model, 'nama_pemilik') ?>

    <?= $form->field($model, 'foto_pemilik') ?>

    <?= $form->field($model, 'no_hp_pemilik') ?>

    <?= $form->field($model, 'no_rekening_pemilik') ?>

    <?= $form->field($model, 'alamat_tanah') ?>

    <?= $form->field($model, 'gambar_tanah') ?> -->

    <!-- <?= $form->field($model, 'kota') ?> -->

    <?= $form->field($model, 'kabupaten') ?>

    <div class="form-group">
        <!-- <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?> -->
    </div>

    <?php ActiveForm::end(); ?>

</div>
