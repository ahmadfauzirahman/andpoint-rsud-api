<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Absensi\MasterAbsensi */

$this->title = 'Update Master Absensi: ' . $model->id_tb_absensi;
$this->params['breadcrumbs'][] = ['label' => 'Master Absensis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tb_absensi, 'url' => ['view', 'id' => $model->id_tb_absensi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-absensi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
