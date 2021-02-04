<?php

namespace app\controllers;

use Yii;
use app\models\Pengumuman;
use app\models\PengumumanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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

            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file != null) {
                $model->file->saveAs(Yii::$app->basePath . '/web/file-pengumuman/' . $model->file->baseName . '.' . $model->file->extension, false);
            } else {
                $model->file = NULL;
            }

            $model->author = Yii::$app->user->identity->id;
            $model->created_at = date('Y-m-d H:i:s');
            $model->update_at = date('Y-m-d H:i:s');
            $model->update_by = Yii::$app->user->identity->id;
            // $image = "data:image/" . file_get_contents(Yii::$app->basePath . '/web/file-pengumuman/' . $model->file);
            $path = Yii::$app->basePath . '/web/file-pengumuman/' . $model->file;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            // var_dump();
            // exit();
            $model->image_encode = $base64;
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id_pengumuman]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pengumuman model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            //file
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file != null) {
                $model->file->saveAs(Yii::$app->basePath . '/web/file-pengumuman/' . $model->file->baseName . '.' . $model->file->extension, FALSE);
            } else {

                $model->file = $model->file;
            }
            $model->update_by = Yii::$app->user->identity->id;
            $model->image_encode = base64_encode($model->file);

            $model->save();
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
}
