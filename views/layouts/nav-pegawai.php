<?php

use yii\helpers\Url;
?>
<li class="text-muted menu-title">Navigation Menu</li>

<li>
    <a href="<?= Url::to(['/site/index']) ?>" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
</li>
<li class="text-muted menu-title">Menu Absensi</li>


<li>
    <a href="<?= Url::to(['/master-absensi/barcode-absensi']) ?>" class="waves-effect"><i class="mdi mdi-qrcode"></i> <span> Barcode Absensi </span> </a>
</li>


<?php
$nik = ['197106241991012001', '196402021989121002'];
?>

<?php if (in_array(Yii::$app->user->identity->kodeAkun, $nik)) { ?>
    <li class="text-muted menu-title">Laporan</li>
    <li>
        <a href="<?= Url::to(['/laporan/laporan-rekap']) ?>" class="waves-effect"><i class="dripicons-checklist"></i> <span>Laporan Rekap </span> </a>
    </li>
<?php } ?>