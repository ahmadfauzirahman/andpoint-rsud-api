<?php

namespace app\models\Absensi\ModelSearch;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Absensi\MasterAbsensi;
use app\models\Kepegawaian\MasterPegawai;
use kartik\daterange\DateRangeBehavior;

/**
 * MasterAbsensiSearch represents the model behind the search form of `app\models\Absensi\MasterAbsensi`.
 */
class MasterAbsensiSearch extends MasterAbsensi
{

    public $createDateStart;
    public $createDateEnd;
    public $namaPegawai;
    public function behaviors()
    {
        return [
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'tanggal_masuk',
                'dateStartAttribute' => 'createDateStart',
                'dateEndAttribute' => 'createDateEnd',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tb_absensi'], 'integer'],
            [['id_pegawai', 'namaPegawai', 'nip_nik', 'jam_masuk', 'jam_keluar', 'tanggal_masuk', 'lat', 'long', 'status'], 'safe'],
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
        $query = MasterAbsensi::find()
            ->leftJoin(MasterPegawai::tableName(), "tb_pegawai.pegawai_id::varchar=tb_absensi.id_pegawai::varchar")
            // ->joinWith(['pegawai'])
            ->orderBy('id_tb_absensi DESC');

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
            'id_tb_absensi' => $this->id_tb_absensi,
            'pegawai.id_pegawai' => $this->namaPegawai,
            'jam_masuk' => $this->jam_masuk,
            'jam_keluar' => $this->jam_keluar,
        ]);

        if ($this->createDateStart && $this->createDateEnd) {
            $query->andFilterWhere(['>=', 'tanggal_masuk', date('Y-m-d', $this->createDateStart)])
                ->andFilterWhere(['<=', 'tanggal_masuk', date('Y-m-d', $this->createDateEnd)]);
        }

        $query->andFilterWhere(['ilike', 'id_pegawai', $this->id_pegawai])
            ->andFilterWhere(['ilike', 'nip_nik', $this->nip_nik])
            ->andFilterWhere(['ilike', 'lat', $this->lat])
            ->andFilterWhere(['ilike', 'long', $this->long]);

        return $dataProvider;
    }
}
