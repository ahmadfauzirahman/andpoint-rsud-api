<?php

use yii\helpers\Url;

?>
<li class="text-muted menu-title">Navigation Menu</li>

<li>
    <a href="<?= Url::to(['/site/index']) ?>" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
</li>

<li class="text-muted menu-title" style="display: none;">Kepagawaian Modul</li>
<li style="display: none;">
    <a href="<?= Url::to(['/master-pegawai/index']) ?>" class="waves-effect"><i class="dripicons-user-group"></i> <span> Pegawai </span> </a>
</li>
<li style="display: none;">
    <a href="<?= Url::to(['/peniliain-iki/index']) ?>" class="waves-effect"><i class="mdi mdi-circle-edit-outline"></i> <span> Penilaian Iki </span> </a>
</li>
<li class="text-muted menu-title">Absensi Modul</li>
<li>
    <a href="<?= Url::to(['/master-absensi/index']) ?>" class="waves-effect"><i class="mdi mdi-car-brake-abs"></i> <span> Data Absensi </span> </a>
</li>
<li>
    <a href="<?= Url::to(['/master-jadwal/index']) ?>" class="waves-effect"><i class="mdi mdi-altimeter"></i> <span> Master Jadwal </span> </a>
</li>
<li class="text-muted menu-title">Master Pegawai</li>
<li>
    <a href="<?= Url::to(['/master-pegawai/index']) ?>" class="waves-effect"><i class="dripicons-user-group"></i> <span> Pegawai </span> </a>
</li>
<li>
    <a href="<?= Url::to(['/master-riwayat-penempatan/index']) ?>" class="waves-effect"><i class="dripicons-checklist"></i> <span> Penempatan </span> </a>
</li>

<li>
    <a href="<?= Url::to(['/master-unit-penempatan/index']) ?>" class="waves-effect"><i class="dripicons-checklist"></i> <span>Unit Penempatan </span> </a>
</li>

<li class="text-muted menu-title" style="display: none;">Master Modul</li>
<li class="has_sub" style="display: none;">
    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-invert-colors"></i> <span> Master HRM </span> <span class="menu-arrow"></span></a>
    <ul class="list-unstyled">
        <li><a href="<?= Url::to(['/DataMaster/master-agama/index']) ?>">Agama</a></li>
        <li><a href="<?= Url::to(['/DataMaster/master-diklat/index']) ?>">Diklat</a></li>
        <li><a href="ui-draggable-cards.html">Draggable Cards</a></li>
        <li><a href="ui-checkbox-radio.html">Checkboxs-Radios</a></li>
        <li><a href="ui-material-icons.html">Material Design Icons</a></li>
        <li><a href="ui-font-awesome-icons.html">Font Awesome</a></li>
        <li><a href="ui-dripicons.html">Dripicons</a></li>
        <li><a href="ui-themify-icons.html">Themify Icons</a></li>
        <li><a href="ui-modals.html">Modals</a></li>
        <li><a href="ui-notification.html">Notification</a></li>
        <li><a href="ui-range-slider.html">Range Slider</a></li>
        <li><a href="ui-components.html">Components</a>
        <li><a href="ui-sweetalert.html">Sweet Alert</a>
        <li><a href="ui-treeview.html">Tree view</a>
        <li><a href="ui-widgets.html">Widgets</a></li>
    </ul>
</li>