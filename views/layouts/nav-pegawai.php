<?php

use yii\helpers\Url;
?>
<li class="text-muted menu-title">Navigation Menu</li>

<li>
    <a href="<?= Url::to(['/master-pegawai/profile-saya']) ?>" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
</li>
<li class="text-muted menu-title">Menu Absensi</li>
<li>
    <a href="<?= Url::to(['/master-absensi/dashboard-ambil-absen']) ?>" class="waves-effect"><i class="mdi mdi-clock"></i> <span> Dashboard Absensi </span> </a>
</li>
<li>
    <a href="<?= Url::to(['/master-absensi/barcode-absensi']) ?>" class="waves-effect"><i class="mdi mdi-qrcode"></i> <span> Barcode Absensi </span> </a>
</li>