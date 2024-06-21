<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "absensi.tb_token".
 *
 * @property int $id_token
 * @property string|null $token
 * @property string|null $id_nip_nrp
 * @property string|null $dv
 */
class TokenFirebase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'absensi.tb_token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['token', 'dv'], 'string'],
            [['id_nip_nrp'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_token' => 'Id Token',
            'token' => 'Token',
            'id_nip_nrp' => 'Id Nip Nrp',
            'dv' => 'Dv',
        ];
    }
}
