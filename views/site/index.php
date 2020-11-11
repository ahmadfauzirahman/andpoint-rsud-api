<?php

/* @var $this yii\web\View */

$this->title = 'Dashboard';
// instantiate the barcode class
// $barcode = new Barcode;
$barcode = new \Com\Tecnick\Barcode\Barcode();
// generate a barcode
$bobj = $barcode->getBarcodeObj(
    'QRCODE,H',                     // barcode type and additional comma-separated parameters
    'https://rsudarifinachmad.riau.go.id',          // data string to encode
    -4,                             // bar width (use absolute or negative value as multiplication factor)
    -4,                             // bar height (use absolute or negative value as multiplication factor)
    'black',                        // foreground color
    array(-2, -2, -2, -2)           // padding (use absolute or negative values as multiplication factors)
)->setBackgroundColor('white')
    ->setSize(270, 270); // background color

// output the barcode as HTML div (see other output formats in the documentation and examples)

?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-body">
                <h6 class="card-title text-black-50">Barcode Disini Untuk Absensi</h6>
                <span class="mr-lg-0"></span>
                <div><?=
                    $bobj->getHtmlDiv();
                    ?></div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card card-body">
                <h6 class="card-title text-black-50">Absen Manual</h6>
                <span class="mr-lg-0"></span>
                <table class="table table-condensed">
                    <tr>
                        <th><h4>Jadwal Kerja</h4></th>
                        <td class="float-right"><h4>Sen, 5 Oktober 2020</h4></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center"><h3><b>07:30 AM . 15:00 PM</b></h3></td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary btn-block  waves-effect w-md waves-light m-b-5">Check In
                            </button>

                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-secondary btn-block waves-effect w-md m-b-5">Check Out</button>
                        </td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>