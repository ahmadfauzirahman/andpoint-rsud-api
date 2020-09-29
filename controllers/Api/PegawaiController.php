<?php

namespace app\controllers\Api;

use app\models\Kepegawaian\MasterPegawai;
use Yii;

class PegawaiController extends ControllerBase
{
    public function actionIndex($q = null, $id =  null)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];

        if (!is_null($q)) {
            $dataPelayanan = MasterPegawai::find()->select(["id_nip_nrp as id", "concat(nama_lengkap,' ',id_nip_nrp) as text"])
                // ->where(['ilike', 'no_rekam_medik', $q . '%', false])
                ->Where(['ilike', 'nama_lengkap', $q . '%', false])
                ->orderBy('nama_lengkap ASC')
                ->asArray()
                ->all();
            $out['results'] = array_values($dataPelayanan);
        } else if ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => MasterPegawai::find($id)->no_rekam_medik];
        }
        return $out;
    }

    // absensi insert
    public function actionInsertAbsensi()
    {
    }

    // api login 
    public function loginAction()
    {
        
    }
}
