<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Absensi\Master\MasterJadwal */

$this->title = 'Form Master Jadwal';
$this->params['breadcrumbs'][] = ['label' => 'Master Jadwal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-jadwal-create">

    <div class="card">
        <div class="card-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>