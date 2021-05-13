<?php

namespace app\controllers;

use app\components\Helper;
use app\models\JadwalSift;
use app\models\Kepegawaian\Master\MasterUnitSubPenempatan;
use app\models\Kepegawaian\MasterPegawai;
use app\models\Kepegawaian\MasterRiwayatPenempatan;
use Yii;
use app\models\OrderJadwal;
use app\models\OrderJadwalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderJadwalController implements the CRUD actions for OrderJadwal model.
 */
class OrderJadwalController extends Controller
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
     * Lists all OrderJadwal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderJadwalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderJadwal model.
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
     * Creates a new OrderJadwal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrderJadwal();

        if ($model->load(Yii::$app->request->post())) {
            $model->created_by = Yii::$app->user->identity->kodeAkun;
            $model->identitas = Yii::$app->user->identity->kodeAkun;
            $model->created_at = date('Y-m-d H:i:s');

            // echo '<pre>';
            // print_r(Yii::$app->request->post());
            // exit;
            $model->save();
            return $this->redirect(['update', 'id' => $model->id_order_jadwal]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing OrderJadwal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $jadwal = JadwalSift::find()
            ->alias("jd")
            ->select([
                'jd.*',
                'mg.nama_lengkap',
                'mg.id_nip_nrp',
            ])->leftJoin(MasterPegawai::tableName() . " as mg", 'jd.identitas_pegawai=mg.id_nip_nrp')
            ->where(['jd.id_order' => $model->id_order_jadwal])->orderBy('mg.nama_lengkap ASC')->asArray()->all();

        $bulan_tahun = explode('-', $model->jadwal);

        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan_tahun[0], $bulan_tahun[1]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_order_jadwal]);
        }

        return $this->render('update', [
            'model' => $model,
            'jadwal' => $jadwal,
            'tanggal' => $tanggal
        ]);
    }

    public function actionGenerate($id, $unit)
    {
        $jadwalDinasFormJson = [];
        $model = $this->findModel($id);
        $bulan_tahun = explode('-', $model->jadwal);

        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan_tahun[0], $bulan_tahun[1]);

        for ($i = 1; $i < $tanggal + 1; $i++) {
            $jadwalDinasFormJson['tanggal-' . $i] = [
                'tglJadwalKeterangan' => 'Jadwal Belum Disetting',
            ];
        }

        //        echo '<pre>';
        //        print_r($jadwalDinasFormJson);
        //        exit();

        $penempatan = MasterRiwayatPenempatan::find()
            ->select([
                'id_nip_nrp as identitas_pegawai',
            ])
            ->where(['penempatan' => $unit, 'status_aktif' => 1])
            ->asArray()
            ->all();
        $penempatan = array_map(function ($d) use ($id, $jadwalDinasFormJson, $bulan_tahun) {
            $d['id_order'] = $id;
            $d['bln'] = $bulan_tahun[0];
            $d['thn'] = $bulan_tahun[1];
            $d['schedule'] = json_encode($jadwalDinasFormJson);
            return $d;
        }, $penempatan);

        //        echo '<pre>';
        //        print_r($penempatan);
        //        exit();
        Helper::batchInsert(JadwalSift::tableName(), [
            'identitas_pegawai', 'id_order', 'bln', 'thn', 'schedule',
        ], $penempatan);

        return $this->redirect(['update', 'id' => $id]);
    }

    /**
     * Deletes an existing OrderJadwal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $model = Yii::$app->db->createCommand("DELETE FROM absensi.tb_jadwal_sift WHERE id_order='$id'");
        $model->execute();
        return $this->redirect(['index']);
    }

    public function actionUpdateJadwal()
    {
        $id = $_POST['idJadwal'];
        $tanggal = $_POST['tanggal'];
        $model = JadwalSift::findOne($id);

        $array = json_decode($model->schedule, true);
        $array[$tanggal] = [
            'tglJadwalKeterangan' => $_POST['val'],
        ];
        $employee_no = $_POST['employee_no'];
        $pegawai = MasterPegawai::findOne($employee_no);
        //var_dump($pegawai);
        //exit();
        $model->schedule = json_encode($array);
        $model->save();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            's' => true,
            'e' => null,
            'namaPegawai' => $pegawai->nama_lengkap

        ];
    }

    /**
     * Finds the OrderJadwal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderJadwal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderJadwal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist . ');
    }

    public function actionCetak($id, $unit)
    {
    }
}
