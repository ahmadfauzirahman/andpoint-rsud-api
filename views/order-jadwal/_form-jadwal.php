<?php

use yii\widgets\Pjax;
use app\components\Helper;

?>
    <hr>
    <style>
        .wrp {
            overflow: auto;
            height: 100%;
        }

        table.dinamis {
            position: relative;
            border-collapse: separate;
            border-spacing: 0;
        }

        table.dinamis th,
        table.dinamis td {
            width: 50px;
            padding: 5px;
            background-color: white;
        }

        table.dinamis tbody {
            height: 90px;
        }

        table.dinamis tr:nth-child(1) th {
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 2;
        }

        table.dinamis tr:nth-child(2) th {
            text-align: center;
            position: sticky;
            top: 33.5px;
            z-index: 2;
        }

        table.dinamis th:nth-child(1) {
            left: 0;
            z-index: 5;
        }

        table.dinamis th:nth-child(2) {
            left: 28px;
            z-index: 6;
        }

        table.dinamis th:nth-child(3) {
            left: 115px;
            z-index: 7;
        }

        table.dinamis td {
            /*text-align: center;*/

        }

        table.dinamis tbody tr td:nth-child(1) {
            position: sticky;
            left: 0;
            z-index: 1;
        }

        table.dinamis tbody tr td:nth-child(2) {
            position: sticky;
            left: 28px;
            z-index: 1;
        }

        table.dinamis tbody tr td:nth-child(3) {
            position: sticky;
            left: 115px;
            z-index: 1;
        }
    </style>
<?php Pjax::begin(['id' => 'pjax-jadwal-gaji']); ?>

    <div class="wrp">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="m-t-0 header-title">Data Absensi <?= $model->sub->nama ?></h4>


                <table class="table table-bordered table-sm dinamis" width="100%">
                    <thead>
                    <tr>
                        <th rowspan="2" width="2%">No</th>
                        <th rowspan="2" width="20%" style="padding-left:100px;padding-right: 100px!important;">Nama</th>
                        <th rowspan="2" width="20%" style="padding-left:100px;padding-right: 100px!important;">Nik</th>
                        <th colspan="<?= $tanggal ?>">Tanggal</th>
                    </tr>
                    <tr>
                        <?php for ($i = 1; $i <= $tanggal; $i++) : ?>
                            <th><?= $i ?></th>
                        <?php endfor; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1;
                    foreach ($jadwal as $item) { ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $item['nama_lengkap'] ?></td>
                            <td><?= $item['id_nip_nrp'] ?></td>

                            <?php foreach (json_decode($item['schedule']) as $key => $dt_absen) { ?>
                                <td style="width: 100px!important;">
                                    <select data-id-jadwal="<?= $item['id_jadwal_sift'] ?>"
                                            data-tanggal="<?= $key ?>"
                                            data-employee_id="<?= $item['id_nip_nrp'] ?>"
                                            onchange="insertAbsen(this)"
                                            style="padding-right: 90px!important;" name="jadwal" id=""
                                            class="form-control form-control-sm">
                                        <option value=""></option>
                                        <?php foreach (Helper::keteranganJadwal() as $jadwal) { ?>
                                            <option <?= ($dt_absen->tglJadwalKeterangan == $jadwal->kode_jadwal) ? 'selected' : null ?>
                                                    value="<?= $jadwal->kode_jadwal ?>"><?= $jadwal->kode_jadwal ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            <?php } ?>
                        </tr>
                        <?php $no++;
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php Pjax::end();

$this->registerJs($this->render('absen-insert.js'), \yii\web\View::POS_END)
?>