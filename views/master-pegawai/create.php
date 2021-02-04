<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kepegawaian\MasterPegawai */

$this->title = 'Create Master Pegawai';
$this->params['breadcrumbs'][] = ['label' => 'Master Pegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-pegawai-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
