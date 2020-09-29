<?php


namespace app\controllers\Api;

use app\components\Helper;
use app\models\Absensi\MasterAbsensi;
use app\models\AkunAknUser;
use app\models\Kepegawaian\MasterPegawai;
use PHPUnit\TextUI\Help;
use Yii;

class AuthController extends ControllerBase
{
    public function actionLogin()
    {
        $p = Yii::$app->request;
        if ($p->isPost) {
            $post = $p->post();

            $kodeAkun = $post['kodeAkun'];
            $password = md5($post['password']);

            //cek nip/nik tidak boleh kosong
            if (is_null($kodeAkun)) {
                return $this->writeResponse(false, 'Nip/Nik Tidak Boleh Kosong', []);
            }

            // cek password tidak boleh kosong
            if (is_null($password)) {
                return $this->writeResponse(false, 'Password Tidak Boleh Kosong', []);
            }

            //cek akun apaakah ada atau tidak
            $model = AkunAknUser::find()->where(['username'=>$kodeAkun])->one();
            if (is_null($model)) {
                return $this->writeResponse(false, 'Akun Tidak Ditemukan Hubungi Admin atau Edp');
            }

            if ($model->username == $kodeAkun && $model->password == $password) {
                return $this->writeResponse(true, 'Berhasil Login', $model);
            } else {
                return $this->writeResponse(false, 'Tidak Berhasil Login', '{}');
            }
        }

        return $this->writeResponse(false, 'Opss', '{}');
    }

    
}
