<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pengumuman */

$this->title = 'Form  Pengumuman';
$this->params['breadcrumbs'][] = ['label' => 'Pengumuman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengumuman-create">

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>


</div>