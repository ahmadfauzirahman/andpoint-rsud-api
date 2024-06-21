<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "absensi.tb_device".
 *
 * @property int $id_device
 * @property string|null $dv
 * @property string|null $identitas_login
 */
class DeviceMobile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'absensi.tb_device';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dv'], 'string'],
            [['identitas_login'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_device' => 'Id Device',
            'dv' => 'Dv',
            'identitas_login' => 'Identitas Login',
        ];
    }
}
