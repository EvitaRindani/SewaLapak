<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Tanah;
use kartik\date\DatePicker;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\DetailTanah */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-tanah-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'tanah_id')->dropDownList(
            ArrayHelper::map(Tanah::find()->all(), 'id_tanah', 'nama_pemilik'), ['prompt' => 'Pilih Tanah']
    )
    ?>

    <?=
    $form->field($model, 'tanggal_tersedia')->widget(DatePicker::className(), [
        'name' => 'tanggal_tersedia',
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'pluginOptions' => [
            'autoClose' => true,
            'format' => 'yyyy-mm-dd',
        ]
    ])
    ?>

    <?=
    $form->field($model, 'waktu_awal')->widget(TimePicker::className(), [
        'pluginOptions' => [
            'showSeconds' => true,
            'showMeridian' => false,
            'minuteStep' => 1,
            'secondStep' => 5,
        ]
    ])
    ?>

    <?=
    $form->field($model, 'waktu_akhir')->widget(TimePicker::className(), [
        'pluginOptions' => [
            'showSeconds' => true,
            'showMeridian' => false,
            'minuteStep' => 1,
            'secondStep' => 5,
        ]
    ])
    ?>

    <?= $form->field($model, 'harga')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
