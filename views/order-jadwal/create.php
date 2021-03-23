<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrderJadwal */

$this->title = 'Form Order Jadwal';
$this->params['breadcrumbs'][] = ['label' => 'Order Jadwal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-jadwal-create">

    <div class="card card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>