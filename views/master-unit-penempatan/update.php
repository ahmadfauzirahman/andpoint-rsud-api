<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kepegawaian\Master\MasterUnitPenempatan */

$this->title = 'Update Master Unit Penempatan: ' . $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Master Unit Penempatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode, 'url' => ['view', 'id' => $model->kode]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-unit-penempatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
