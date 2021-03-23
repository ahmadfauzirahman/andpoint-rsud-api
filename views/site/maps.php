<?php

/* @var $this yii\web\View */

use app\models\Absensi\MasterAbsensi;
use app\models\Kepegawaian\MasterPegawai;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Tracking Pegawai RSUD';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <div id="map" style="width:100%;height:580px;"></div>

                <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1H72Fojan6yCxKf5DhNXD1Er4Y60ngWU&callback=myMap"></script>

                <script type="text/javascript">
                    function initialize() {

                        var mapOptions = {
                            zoom: 16,
                            center: new google.maps.LatLng(0.5233203, 101.451869, 15),
                            disableDefaultUI: true
                        };

                        var mapElement = document.getElementById('map');

                        var map = new google.maps.Map(mapElement, mapOptions);

                        setMarkers(map, officeLocations);

                    }

                    var officeLocations = [
                        <?php foreach (MasterAbsensi::find()->where(['tanggal_masuk' => date("Y-m-d")])->orderBy('tanggal_masuk DESC')->all() as $item) {
                             $d = MasterPegawai::findOne(['pegawai_id' => $item->id_pegawai]);

                             ?>[<?= $item->nip_nik ?>, "<?= $d->nama_lengkap ?>", '<?= $item->how ?>', <?= $item->long ?>, <?= $item->lat ?>],
                        <?php } ?>
                    ];

                    function setMarkers(map, locations) {
                        var globalPin = 'http://presensi.simrs.aa/img/marker.png';

                        for (var i = 0; i < locations.length; i++) {

                            var office = locations[i];
                            var myLatLng = new google.maps.LatLng(office[4], office[3]);
                            var infowindow = new google.maps.InfoWindow({
                                content: contentString
                            });

                            var contentString =
                                '<div id="content">' +
                                '<div id="siteNotice">' +
                                '</div>' +
                                '<h5 id="firstHeading" class="firstHeading">' + office[1] + '</h5>' +
                                '<div id="bodyContent">' +
                                '<a target="_blank" href=<?= Url::to(['/site/check-pegawai']) ?>?id=' + office[0] + ' class="btn btn-trans btn-info btn-block" >Info Detail</a>' +
                                '</div>' +
                                '</div>';

                            var marker = new google.maps.Marker({
                                position: myLatLng,
                                map: map,
                                title: office[1],
                                icon: 'http://presensi.simrs.aa/img/marker.png'
                            });

                            google.maps.event.addListener(marker, 'click', getInfoCallback(map, contentString));
                        }
                    }

                    function getInfoCallback(map, content) {
                        var infowindow = new google.maps.InfoWindow({
                            content: content
                        });
                        return function() {
                            infowindow.setContent(content);
                            infowindow.open(map, this);
                        };
                    }

                    initialize();
                </script>
            </div>
        </div>
    </div>
</div>