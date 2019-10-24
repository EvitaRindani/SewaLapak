<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tanah */

$this->title = 'Perbaharui Lapak: ' . $model->id_tanah;
$this->params['breadcrumbs'][] = ['label' => 'Sewa Lapak', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tanah, 'url' => ['view', 'id' => $model->id_tanah]];
$this->params['breadcrumbs'][] = 'Perbaharui';
?>
<div class="tanah-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
