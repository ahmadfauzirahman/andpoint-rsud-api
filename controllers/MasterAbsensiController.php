<?php

namespace app\controllers;

use app\models\Absensi\Master\MasterJadwal;
use Yii;
use app\models\Absensi\MasterAbsensi;
use app\models\Absensi\ModelSearch\MasterAbsensiSearch;
use app\models\Kepegawaian\Master\MasterUnitPenempatan;
use app\models\Kepegawaian\MasterPegawai;
use app\models\Kepegawaian\MasterRiwayatPenempatan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MasterAbsensiController implements the CRUD actions for MasterAbsensi model.
 */
class MasterAbsensiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MasterAbsensi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MasterAbsensiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MasterAbsensi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MasterAbsensi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MasterAbsensi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_tb_absensi]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MasterAbsensi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_tb_absensi]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDashboardAmbilAbsen()
    {
        $absen = MasterAbsensi::find()
            ->where(['tanggal_masuk' => date("Y-m-d")])
            ->orderBy('tanggal_masuk DESC')
            ->all();
        return $this->render(
            'ambil-absen',
            [
                'absenHarini' => $absen
            ]
        );
    }

    public function actionBarcodeAbsensi()
    {
        return $this->render('barcode');
    }

    // save absen 
    public function actionAmbilAbsenSave()
    {

        if (Yii::$app->request->isPost) {
            $p = Yii::$app->request->post();
            $model = new MasterAbsensi();

            $nip = $p['nip'];

            // ambil data pegawai untuk keperluan
            $pegawai = MasterPegawai::findOne(['id_nip_nrp' => $nip]);

            // chek jadwal kerja berdasarkan unit penempatan terakhir
            $unit = self::checkJadwalKaryawan($nip);

            // chek absen 

            if ($unit->status_pegawai == 'PEGAWAI NON SHIFF') {
                // ambil data absen dihari skrg untuk yang tidak siff
                $absen = MasterAbsensi::find()->where(["tanggal_masuk" => date("Y-m-d")])
                    ->andWhere(['nip_nik' => $nip])->one();

                // jika kondisi absen null maka insert absen masuk dalam kondisi pegawai tidak ada mengajukan cuti atau izin sakit
                // kondisi cuti dan izin belum dibuat
                if (is_null($absen)) {
                    $model->id_pegawai = (string)$pegawai->pegawai_id;
                    $model->nip_nik = $nip;
                    $model->jam_masuk = date('H:i:s');
                    $model->jam_keluar = "";
                    $model->tanggal_masuk = date('Y-m-d');
                    $model->lat = "0.5233203";
                    $model->long = "101.451869,15";
                    $model->status = "h";
                    $model->how = "Web";

                    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                    if ($model->save()) {
                        return [
                            's' => true,
                            'e' => null
                        ];
                    } else {
                        return [
                            's' => false,
                            'e' => $model->errors
                        ];
                    }
                } else {
                    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    $absen->jam_keluar = date('H:i:s');
                    if ($absen->save()) {
                        return [
                            's' => true,
                            'e' => null
                        ];
                    } else {
                        return [
                            's' => false,
                            'e' => $model->errors
                        ];
                    }
                }
            }
        }
    }

    //cek unit kerja terakhir karyawan skrg dimana 
    public static function checkJadwalKaryawan($nip)
    {
        // ambil data penampatan terakahir
        $penempatan = MasterRiwayatPenempatan::find()
            ->where(['id_nip_nrp' => $nip])
            ->orderBy('tanggal DESC')->limit(1)->one();

        // ambil data jadwal master berdasarkan unit kerja
        $unit =  MasterJadwal::findOne(['kode_unit_kerja' => $penempatan->unit_kerja]);
        return $unit;
    }


    /**
     * Deletes an existing MasterAbsensi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MasterAbsensi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MasterAbsensi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MasterAbsensi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
