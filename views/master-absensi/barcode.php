<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'QRCODE Abensi';
$this->params['breadcrumbs'][] = $this->title;
$barcode = new \Com\Tecnick\Barcode\Barcode();

$isibarcode = new \stdClass();

$isibarcode->nip_pegawai = Yii::$app->user->identity->kodeAkun;
$isibarcode->tanggal = date('Y-m-d');
$isibarcode->valid = 'rsudarifinachmad.riau.go.id';
$myJSON = json_encode($isibarcode);

// generate a barcode
$bobj = $barcode->getBarcodeObj(
    'QRCODE,H',                     // barcode type and additional comma-separated parameters
    $myJSON ,          // data string to encode
    -4,                             // bar width (use absolute or negative value as multiplication factor)
    -4,                             // bar height (use absolute or negative value as multiplication factor)
    'black',                        // foreground color
    array(-2, -2, -2, -2)           // padding (use absolute or negative values as multiplication factors)
)->setBackgroundColor('white')
    ->setSize(470, 470); // background color
?>
<div class="site-about">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body ">
                <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
                <div style="margin: 0px auto;">
                    <?= $bobj->getHtmlDiv() ?>
                </div>
            </div>

        </div>
    </div>
</div>