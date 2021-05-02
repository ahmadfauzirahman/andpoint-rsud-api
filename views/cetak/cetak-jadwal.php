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

use yii\helpers\Json;
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
        padding: 5px;
    }

    .tabel-absen tr td {
        border: 1px solid black;
        font-size: medium;
        text-align: center;
        padding: 5px;
    }

    .tabel-absen-kanan {
        border-collapse: collapse;
    }

    .tabel-absen-kanan tr th {
        border: 1px solid black;
        font-size: medium;
        text-align: center;
        padding: 3.3px;
    }

    .tabel-absen-kanan tr td {
        border: 1px solid black;
        font-size: medium;
        text-align: center;
        padding: 3.3px;
    }
</style>

<?php

// for ($i = 0; $i < $berapaLembar; $i++) {
//     if ($i != 0) echo '<pagebreak></pagebreak>';

?>
<div class="page-absen">
    <div style="text-align: center; font-weight: bold;">
        JADWAL SHIFT PROGRAMMER<br>
        INSTALASI ELECTRONIC DATA PROCESSING (EDP)<br>
        RSUD ARIFIN ACHMAD PROVINSI RIAU PERIODE<br>
        <?= strtoupper($periode) ?><br>

    </div>

    <div style="width: 80%; background-color: white; float: left; margin-right: 10px;">
        <table class="tabel-absen" style="width: 100%; margin-top: 55px;">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th>Hari</th>
                    <?php
                    $hariPendek = [
                        'Senin' => 'Sen',
                        'Selasa' => 'Sel',
                        'Rabu' => 'Rab',
                        'Kamis' => 'Kam',
                        'Jumat' => 'Jum',
                        'Sabtu' => 'Sab',
                        'Minggu' => 'Mg',
                    ];
                    setlocale(LC_ALL, 'id_ID');
                    $begin = new DateTime($startDate);
                    $end   = new DateTime($endDate);
                    $hariMinggu = [];
                    for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
                        $warnaKu = 'black';
                        $hariPendekku = $hariPendek[Yii::$app->formatter->asDate($i->format("Y-m-d"), 'php:l')];
                        if ($hariPendekku == 'Mg') {
                            array_push($hariMinggu, $i->format("d"));
                            $warnaKu = 'red';
                        }
                        echo '<th style="color: ' . $warnaKu . '">' . $hariPendekku . '</th>';
                    }
                    ?>
                </tr>
                <tr>
                    <th>Nama / Tanggal</th>
                    <?php
                    for ($i = $startDay; $i <= $endDay; $i++) {
                        $warnaKu = 'black';
                        if (in_array($i, $hariMinggu)) {
                            $warnaKu = 'red';
                        }
                        echo '<th style="color: ' . $warnaKu . '">' . $i . '</th>';
                    }
                    ?>
                </tr>
                <tr>
                    <?php
                    // for ($i_tanggal = $startDayTanggal; $i_tanggal < ($startDayTanggal + 6); $i_tanggal++) {
                    //     if ($i_tanggal > $endDay)
                    //         echo '
                    //         <th colspan="4" style="width: 48px;">&nbsp;</th>
                    //     ';
                    //     else
                    //         echo '
                    //         <th colspan="4" style="width: 48px;">' . $i_tanggal . '</th>
                    //     ';
                    // }
                    // $startDayTanggal = $i_tanggal;
                    ?>
                </tr>
                <tr>
                    <?php
                    // for ($i_pukul = $startDayPukul; $i_pukul < ($startDayPukul + 6); $i_pukul++) {
                    //     if ($i_pukul > $endDay)
                    //         echo '
                    //         <th style="width: 12px; color: white;">Pukul Masuk</th>
                    //         <th style="width: 12px; color: white;">TTD</th>
                    //         <th style="width: 12px; color: white;">Pukul Pulang</th>
                    //         <th style="width: 12px; color: white;">TTD</th>
                    //     ';
                    //     else
                    //         echo '
                    //         <th style="width: 12px;">Pukul Masuk</th>
                    //         <th style="width: 12px;">TTD</th>
                    //         <th style="width: 12px;">Pukul Pulang</th>
                    //         <th style="width: 12px;">TTD</th>
                    //     ';
                    // }
                    // $startDayPukul = $i_pukul;
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($jadwalSift as $key => $value) {
                    $schedule = Json::decode($value->schedule, $asArray = true);
                    // echo "<pre>";
                    // print_r(count($schedule));
                    // print_r($schedule);
                    // echo "</pre>";
                    // die;
                    echo '
                        <tr>
                            <td>' . ($key + 1) . '</td>
                            <td style="white-space:nowrap">' . ($value->pegawai->nama_lengkap ?? '-') . '</td>
                            ';
                    for ($i = $startDay; $i <= $endDay; $i++) {
                        $jadwalSiftKu = ($schedule['tanggal-' . $i]['tglJadwalKeterangan'] == 'Jadwal Belum Disetting' ? '' : $schedule['tanggal-' . $i]['tglJadwalKeterangan']);
                        $warnaTd = 'white';
                        if ($jadwalSiftKu == 'L')
                            $warnaTd = 'red';
                        echo '<td style="background-color: ' . $warnaTd . '">' . $jadwalSiftKu . '</td>';
                    }

                    echo '
                        </tr>
                    ';
                }
                ?>
                <?php
                // foreach ($org_edp as $key => $value) {

                //     $ttd = '<img style="width: 52px;" src="' . Url::to('@web/img/ttd/INSTALASI ELECTRONIC DATA PROCESSING/' . $value['id'] . '.png') . '" />';

                //     echo '
                //     <tr>
                //         <td>' . ($key + 1) . '</td>
                //         <td  style="white-space:nowrap; text-align: left; padding: 20px 10px 20px 10px;">' . $value['nama'] . '</td>
                //         <td  style="white-space:nowrap">' . $value['jabatan'] . '</td>
                //         ';
                //     // loop untuk print ttd & jam masuk pulang setiap halaman 
                //     // $i_ttd = tanggal 
                //     for ($i_ttd = $startDayTtd; $i_ttd < ($startDayTtd + 6); $i_ttd++) {
                //         if ($i_ttd > $endDay) {
                //             echo '<td style="padding: 1px 1px 1px 1px;"></td>';
                //             echo '<td style="padding: 1px 1px 1px 1px;"></td>';
                //             echo '<td style="padding: 1px 1px 1px 1px;"></td>';
                //             echo '<td style="padding: 1px 1px 1px 1px;"></td>';
                //         } else {
                //             echo '<td style="padding: 1px 1px 1px 1px;">' . (isset($value['absensi'][$i_ttd]) ? $value['absensi'][$i_ttd]['jam_masuk'] : '-') . '</td>';
                //             echo '<td style="padding: 1px 3px 1px 3px;">' . (isset($value['absensi'][$i_ttd]) ? $ttd : '-') . '</td>';
                //             echo '<td style="padding: 1px 1px 1px 1px;">' . (isset($value['absensi'][$i_ttd]) ? $value['absensi'][$i_ttd]['jam_pulang'] : '-') . '</td>';
                //             echo '<td style="padding: 1px 3px 1px 3px;">' . (isset($value['absensi'][$i_ttd]) ? $ttd : '-') . '</td>';
                //         }
                //     }
                //     echo '</tr>
                // ';
                // }
                // $startDayTtd = $i_ttd;
                ?>
            </tbody>
        </table>
    </div>
    <div style="width: 20%; background-color: white; float: left; margin-left: 10px;">
        <table class="tabel-absen-kanan" style="width: 100%; margin-top: 32px; font-size: 8px;">
            <thead>
                <tr>
                    <th colspan="6">JUMLAH</th>
                </tr>
                <tr>
                    <th>L</th>
                    <th>P</th>
                    <th>S</th>
                    <th>M</th>
                    <th>Jam</th>
                    <th>Hari</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($jadwalSift as $key => $value) {
                    $schedule = Json::decode($value->schedule, $asArray = true);
                    // echo "<pre>";
                    // print_r(count($schedule));
                    // print_r($schedule);
                    // echo "</pre>";
                    // die;
                    echo '
                        <tr>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    // if ($i == ($berapaLembar - 1)) :
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
    // endif;
    ?>

</div>

<?php
// }
?>