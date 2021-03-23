<?php

namespace app\controllers;

use Yii;
use app\models\Pengumuman;
use app\models\PengumumanSearch;
use app\models\Kepegawaian\Master\MasterUnitPenempatan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/**
 * PengumumanController implements the CRUD actions for Pengumuman model.
 */
class PengumumanController extends Controller
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
     * Lists all Pengumuman models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PengumumanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pengumuman model.
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
     * Creates a new Pengumuman model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pengumuman();
		
        if ($model->load(Yii::$app->request->post())) {
			
			// echo "<pre>"; var_dump($model->to);exit;;
            
            $model->author = Yii::$app->user->identity->id;
            $model->created_at = date('Y-m-d H:i:s');
            $model->update_at = date('Y-m-d H:i:s');
            $model->update_by = Yii::$app->user->identity->id;
            
			$model->isi=str_replace('"',"'",$model->isi);
			
			if($model->status=="Publish"){
				self::blastPushNotification($model->title,$model->isi,$model->to);
			}
			
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id_pengumuman]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
	
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
			
            $model->update_by = Yii::$app->user->identity->id;
			
			$model->isi=str_replace('"',"'",$model->isi);
			if($model->status=="Publish"){
				self::blastPushNotification($model->title,$model->isi,$model->to);
			}
			
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id_pengumuman]);
        }
		

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pengumuman model.
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
     * Finds the Pengumuman model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pengumuman the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pengumuman::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	
    public static function actionGetUnitPenempatan()
    {
        header('Content-Type: application/json');
        $unit = MasterUnitPenempatan::find()->asArray()->all();
        $unit = ArrayHelper::map($unit, 'kode', 'nama');
        return json_encode($unit);
    }
	
	
	public static function findPegawaiPenempatan($unit){
		// echo "<pre>"; var_dump($unit);exit;;
		$connection = Yii::$app->getDb();
		if($unit==""){ //all
			// exit;
			$command = $connection->createCommand("
				select
					a.id_nip_nrp,
					a.nama_lengkap,
					t.token
				from
					pegawai.tb_pegawai a
				left join pegawai.tb_riwayat_penempatan b on
					b.id_nip_nrp = a.id_nip_nrp
				left join pegawai.tb_unit_plt_plh c on
					c.id_nip_nrp = a.id_nip_nrp
				inner join absensi.tb_token t on
					t.id_nip_nrp = a.id_nip_nrp
				", []);
		}else{
			$command = $connection->createCommand("
				select
					a.id_nip_nrp,
					a.nama_lengkap,
					t.token
				from
					pegawai.tb_pegawai a
				left join pegawai.tb_riwayat_penempatan b on
					b.id_nip_nrp = a.id_nip_nrp
				left join pegawai.tb_unit_plt_plh c on
					c.id_nip_nrp = a.id_nip_nrp
				inner join absensi.tb_token t on
					t.id_nip_nrp = a.id_nip_nrp
				where
					(
					((a.status_aktif_pegawai = 1)
					and ((
					select
						d.unit_kerja
					from
						pegawai.tb_riwayat_penempatan d
					where
						d.id_nip_nrp = a.id_nip_nrp
					order by
						d.tanggal desc
					limit 1) = :unit1))
					or ((
					select
						e.unit_kerja
					from
						pegawai.tb_unit_plt_plh e
					where
						(e.id_nip_nrp = a.id_nip_nrp)
						and (e.status = 1)) = :unit2)
					)
					and 
				--		a.id_nip_nrp in ('1403012008940003')		 -- bagus dan 0000000000
						a.id_nip_nrp IS NOT NULL
				--		a.id_nip_nrp not in ('196911181994031004')
					
				", [':unit1' => $unit, ':unit2' => $unit]);
		}
		$result = $command->queryAll();
		return $result;
	}
	
	public static function strip_tags_content($text) {
		return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);		
	}
	
	public static function blastPushNotification($judul="-",$pesan="-",$to){
		
		$pesan = strip_tags($pesan);
		
		$result=self::findPegawaiPenempatan($to);			
		// echo "<pre>";print_r($result);
		// echo "<br>";
		$nip_nik=[];
		$counter=0;
		$sesi=0;
		foreach ($result as $re){
			if($counter>998){ //karena firebase limit 1000 kirim bulk
				$counter=0;
				$sesi++;
			}			
			$counter++;
			$nip_nik[$sesi][]=$re['token'];
		}
		// $nip_nik=json_encode($nip_nik);
		
		// echo "blastPushNotification";
		// echo $judul;
		// echo $pesan; 
		foreach ($nip_nik as $npk){
			$npk=json_encode($npk);
			// echo $npk;		
			// exit;			
			$ch = curl_init(); 
			$headers  = [
						'Authorization: key=AAAAqy_kWts:APA91bFxP71kZgM-wUVqVDVoUZNmj5WeiSavmV_nf5DIqORW0bSqmHaWapYSOCr3fjitqDAsskoKtL9eyDei5BRJEvLXZpE62pNNSvFQX2FPt7waNUmRR2o2Ci6K_Q7o09DhfGO3koLv',
						'Content-Type: application/json'
					];
			$postData = '
				{
					"notification": {
						"body": "'.$pesan.'",
						"title": "'.$judul.'",
						"data": "path"
					},
					"priority": "high",
					"data": {
						"click_action": "FLUTTER_NOTIFICATION_CLICK",
						"id": "1",
						"status": "done"
					},
					"registration_ids": '.$npk.'
				}
			';
			curl_setopt($ch, CURLOPT_URL,"https://fcm.googleapis.com/fcm/send");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$postData);           
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result     = curl_exec ($ch);
			$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			
			// echo "<br>";
			// echo "<br>";
			// echo "<br>";
			// echo $result;
			// echo "<br>";
			// echo $statusCode;
			// exit; 
			sleep(2);
		}
		// echo $nip_nik;
		// exit;
		
		return false;
	}
}
