<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Kepegawaian\ModelSearch\MasterPegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Laporan Absensi';
$this->params['breadcrumbs'][] = $this->title;
$tahun = date('Y'); //Mengambil tahun saat ini
$bulan = date('m'); //Mengambil bulan saat ini
$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
// echo $tanggal
?>

<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-header" style="background-color: #ffffff;">
                <h4 class="card-title"><?= $this->title ?></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" cellspacing="1" border="1">
                        <tr>
                            <td valign=middle height="83" style="text-align: center;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan="3">NO</td>
                            <td style="text-align: center;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan="3">NAMA</td>
                            <td style="text-align: center;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan="3">GOL</td>
                            <td style="text-align: center;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan="<?= $tanggal ?>">TANGGAL/PUKUL MASUK/PUKUL PULANG/TANDA TANGAN </td>
                        </tr>
                        <tr>

                            <?php for ($i = 1; $i <= $tanggal; $i++) {
                            ?>
                                <td style="text-align: center;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan="4"><?= $i ?></td>
                            <?php }
                            ?>
                        </tr>
                        <tr>

                            <?php for ($i = 1; $i <= $tanggal; $i++) {
                            ?>
                                <td style="text-align: center;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">PUKUL MASUK</td>
                                <td style="text-align: center;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">TTD</td>
                                <td style="text-align: center;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">PUKUL PULANG</td>
                                <td style="text-align: center;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">TTD</td>
                            <?php }
                            ?>
                        </tr>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>AHMAD FAUZI RAHMAN</td>
                                <td>XI</td>
                                <td>XI</td>
                                <td>XI</td>
                                <td>XI</td>
                                <td>XI</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>