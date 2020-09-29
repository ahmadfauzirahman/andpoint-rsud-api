<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<div class="site-error">
    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div class="ex-page-content text-center">
            <div class="text-error" style="font-size: 52px;!important"><p><?= Html::encode($this->title) ?></p></div>
            <h3 class="text-uppercase font-600"> <?= nl2br(Html::encode($message)) ?></h3>
            <p class="text-muted">
               Mau Kemana Om??
            </p>
            <br>
            <a class="btn btn-success waves-effect waves-light" href="<?= Url::to(['/site/index']) ?>"> Return Home</a>

        </div>
    </div>
</div>