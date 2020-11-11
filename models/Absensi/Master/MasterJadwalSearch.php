<?php

namespace app\models\Absensi\Master;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Absensi\Master\MasterJadwal;

/**
 * MasterJadwalSearch represents the model behind the search form of `app\models\Absensi\Master\MasterJadwal`.
 */
class MasterJadwalSearch extends MasterJadwal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jadwal'], 'integer'],
            [['senin_kamis_masuk', 'jumat', 'sabtu', 'status_pegawai','status_jadwal'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MasterJadwal::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_jadwal' => $this->id_jadwal,
            'senin_kamis_masuk' => $this->senin_kamis_masuk,
            'jumat' => $this->jumat,
            'sabtu' => $this->sabtu,
        ]);

        $query->andFilterWhere(['ilike', 'status_pegawai', $this->status_pegawai]);

        return $dataProvider;
    }
}
