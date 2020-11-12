<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kepegawaian\Master\MasterUnitPenempatan */

$this->title = 'Create Master Unit Penempatan';
$this->params['breadcrumbs'][] = ['label' => 'Master Unit Penempatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-unit-penempatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
