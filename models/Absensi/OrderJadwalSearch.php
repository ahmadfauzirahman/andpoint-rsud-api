<?php

namespace app\models\Absensi;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Absensi\OrderJadwal;

/**
 * OrderJadwalSearch represents the model behind the search form of `app\models\Absensi\OrderJadwal`.
 */
class OrderJadwalSearch extends OrderJadwal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_order_jadwal'], 'integer'],
            [['kode_sub_rumpun', 'bulan', 'tahun', 'created_by', 'created_at'], 'safe'],
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
        $query = OrderJadwal::find();

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
            'id_order_jadwal' => $this->id_order_jadwal,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['ilike', 'kode_sub_rumpun', $this->kode_sub_rumpun])
            ->andFilterWhere(['ilike', 'bulan', $this->bulan])
            ->andFilterWhere(['ilike', 'tahun', $this->tahun])
            ->andFilterWhere(['ilike', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
