<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kepegawaian\Master\MasterDiklat */

$this->title = 'Create Master Diklat';
$this->params['breadcrumbs'][] = ['label' => 'Master Diklats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-diklat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
