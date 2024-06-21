<?php

namespace app\controllers;

use Yii;
use app\models\Absensi\Master\MasterJadwal;
use app\models\Absensi\Master\MasterJadwalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MasterJadwalController implements the CRUD actions for MasterJadwal model.
 */
class MasterJadwalController extends Controller
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
     * Lists all MasterJadwal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MasterJadwalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MasterJadwal model.
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
     * Creates a new MasterJadwal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MasterJadwal();

        if ($model->load(Yii::$app->request->post())) {
            $p = Yii::$app->request->post();
            $unitKerja = $p['MasterJadwal']['kode_unit_kerja'];
            $senin_rabu_masuk = $p['MasterJadwal']['senin_rabu_masuk'];
            $kamis = $p['MasterJadwal']['kamis'];
            $jumat = $p['MasterJadwal']['jumat'];
            $status_pegawai = $p['MasterJadwal']['status_pegawai'];
            $status_jadwal = $p['MasterJadwal']['status_jadwal'];
            // var_dump(count($unitKerja));
            // exit;
            for ($i = 0; $i < count($unitKerja); $i++) {
                $model = new MasterJadwal();
                $model->kode_unit_kerja = $unitKerja[$i];
                $model->senin_rabu_masuk = $senin_rabu_masuk;
                $model->jumat = $jumat;
                $model->kamis = $kamis;
                $model->status_pegawai = $status_pegawai;
                $model->status_jadwal = $status_jadwal;
                $model->save();
            }
            // exit();
            // exit();
            return $this->redirect(['master-jadwal/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MasterJadwal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_jadwal]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MasterJadwal model.
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
     * Finds the MasterJadwal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MasterJadwal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MasterJadwal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
