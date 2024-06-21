<?php

namespace app\models\Kepegawaian;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kepegawaian\MasterRiwayatPenempatan;

/**
 * MasterRiwayatPenempatanSearch represents the model behind the search form of `app\models\Kepegawaian\MasterRiwayatPenempatan`.
 */
class MasterRiwayatPenempatanSearch extends MasterRiwayatPenempatan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'atasan_langsung', 'penempatan', 'sdm_rumpun', 'sdm_sub_rumpun', 'sdm_jenis', 'unit_kerja'], 'integer'],
            [['id_nip_nrp', 'nota_dinas', 'tanggal', 'dokumen'], 'safe'],
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
        $query = MasterRiwayatPenempatan::find();

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
            'id' => $this->id,
            'tanggal' => $this->tanggal,
            'atasan_langsung' => $this->atasan_langsung,
            'penempatan' => $this->penempatan,
            'sdm_rumpun' => $this->sdm_rumpun,
            'sdm_sub_rumpun' => $this->sdm_sub_rumpun,
            'sdm_jenis' => $this->sdm_jenis,
            'unit_kerja' => $this->unit_kerja,
        ]);

        $query->andFilterWhere(['ilike', 'id_nip_nrp', $this->id_nip_nrp])
            ->andFilterWhere(['ilike', 'nota_dinas', $this->nota_dinas])
            ->andFilterWhere(['ilike', 'dokumen', $this->dokumen]);

        return $dataProvider;
    }
}
