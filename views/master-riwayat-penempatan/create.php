<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kepegawaian\MasterRiwayatPenempatan */

$this->title = 'Create Master Riwayat Penempatan';
$this->params['breadcrumbs'][] = ['label' => 'Master Riwayat Penempatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-riwayat-penempatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
