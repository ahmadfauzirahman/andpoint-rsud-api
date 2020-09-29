<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Profile Saya';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $nilai = (int)10;
    $nilai = $nilai++;
    // print_r($nilai);
    ?>
    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>