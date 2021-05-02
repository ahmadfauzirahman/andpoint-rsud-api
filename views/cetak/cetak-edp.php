<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-03-25 13:16:39 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-03-25 14:46:54
 */

/* @var $this yii\web\View */

use yii\helpers\Url;

?>

<style>
    .tabel-absen {
        border-collapse: collapse;
    }

    .tabel-absen tr th {
        border: 1px solid black;
        font-size: medium;
        text-align: center;
        padding: 10px;
    }

    .tabel-absen tr td {
        border: 1px solid black;
        font-size: medium;
        text-align: center;
        padding: 10px;
    }
</style>

<?php

for ($i = 0; $i < $berapaLembar; $i++) {
    if ($i != 0) echo '<pagebreak></pagebreak>';

?>
    <div class="page-absen">
        <div style="text-align: center; font-weight: bold;">
            DAFTAR TENAGA AHLI PROGRAMMER BIDANG TEKNOLOGI INFORMASI<br>
            DI INSTALASI ELECTRONIC DATA PROCESSING (EDP)<br>
            RSUD ARIFIN ACHMAD PROVINSI RIAU PERIODE <?= strtoupper($periode) ?><br>

        </div>

        <table class="tabel-absen" style="width: 100%; margin-top: 55px;">
            <thead>
                <tr>
                    <th rowspan="3">No</th>
                    <th rowspan="3">Nama</th>
                    <th rowspan="3">Jabatan</th>
                    <th colspan="24" style="width: 288px; font-size: large;">Tanggal/Pukul Masuk, Pukul Pulang/Tanda Tangan</th>
                </tr>
                <tr>
                    <?php
                    for ($i_tanggal = $startDayTanggal; $i_tanggal < ($startDayTanggal + 6); $i_tanggal++) {
                        if ($i_tanggal > $endDay)
                            echo '
                            <th colspan="4" style="width: 48px;">&nbsp;</th>
                        ';
                        else
                            echo '
                            <th colspan="4" style="width: 48px;">' . $i_tanggal . '</th>
                        ';
                    }
                    $startDayTanggal = $i_tanggal;
                    ?>
                </tr>
                <tr>
                    <?php
                    for ($i_pukul = $startDayPukul; $i_pukul < ($startDayPukul + 6); $i_pukul++) {
                        if ($i_pukul > $endDay)
                            echo '
                            <th style="width: 12px; color: white;">Pukul Masuk</th>
                            <th style="width: 12px; color: white;">TTD</th>
                            <th style="width: 12px; color: white;">Pukul Pulang</th>
                            <th style="width: 12px; color: white;">TTD</th>
                        ';
                        else
                            echo '
                            <th style="width: 12px;">Pukul Masuk</th>
                            <th style="width: 12px;">TTD</th>
                            <th style="width: 12px;">Pukul Pulang</th>
                            <th style="width: 12px;">TTD</th>
                        ';
                    }
                    $startDayPukul = $i_pukul;
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($org_edp as $key => $value) {

                    $ttd = '<img style="width: 52px;" src="' . Url::to('@web/img/ttd/INSTALASI ELECTRONIC DATA PROCESSING/' . $value['id'] . '.png') . '" />';

                    echo '
                    <tr>
                        <td>' . ($key + 1) . '</td>
                        <td  style="white-space:nowrap; text-align: left; padding: 20px 10px 20px 10px;">' . $value['nama'] . '</td>
                        <td  style="white-space:nowrap">' . $value['jabatan'] . '</td>
                        ';
                    // loop untuk print ttd & jam masuk pulang setiap halaman 
                    // $i_ttd = tanggal 
                    for ($i_ttd = $startDayTtd; $i_ttd < ($startDayTtd + 6); $i_ttd++) {
                        if ($i_ttd > $endDay) {
                            echo '<td style="padding: 1px 1px 1px 1px;"></td>';
                            echo '<td style="padding: 1px 1px 1px 1px;"></td>';
                            echo '<td style="padding: 1px 1px 1px 1px;"></td>';
                            echo '<td style="padding: 1px 1px 1px 1px;"></td>';
                        } else {
                            echo '<td style="padding: 1px 1px 1px 1px;">' . (isset($value['absensi'][$i_ttd]) ? $value['absensi'][$i_ttd]['jam_masuk'] : '-') . '</td>';
                            echo '<td style="padding: 1px 3px 1px 3px;">' . (isset($value['absensi'][$i_ttd]) ? $ttd : '-') . '</td>';
                            echo '<td style="padding: 1px 1px 1px 1px;">' . (isset($value['absensi'][$i_ttd]) ? $value['absensi'][$i_ttd]['jam_pulang'] : '-') . '</td>';
                            echo '<td style="padding: 1px 3px 1px 3px;">' . (isset($value['absensi'][$i_ttd]) ? $ttd : '-') . '</td>';
                        }
                    }
                    echo '</tr>
                ';
                }
                $startDayTtd = $i_ttd;
                ?>
            </tbody>
        </table>

        <?php
        if ($i == ($berapaLembar - 1)) :
        ?>
            <table style="width: 100%; margin-top: 25px;">
                <tbody>
                    <tr>
                        <td style="width: 75%;"></td>
                        <td style="width: 25%; text-align: center;">
                            Pekanbaru, <?= Yii::$app->formatter->asDate($endDate, 'php:d F Y') ?>
                            <br>
                            Kepala Instalasi EDP
                            <br>
                            <br>
                            <br>
                            <span style="text-decoration: underline;">
                                <?= $kepala_edp['nama'] ?>
                            </span>
                            <br>
                            NIP. <?= $kepala_edp['nip'] ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php
        endif;
        ?>

    </div>

<?php
}
?>