<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kepegawaian\Master\MasterDiklat */

$this->title = 'Update Master Diklat: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Master Diklats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-diklat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
