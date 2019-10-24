<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\DetailTanah;

/**
 * DetailTanahSearch represents the model behind the search form about `frontend\models\DetailTanah`.
 */
class DetailTanahSearch extends DetailTanah
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_detail', 'tanah_id'], 'integer'],
            [['tanggal_tersedia', 'waktu_awal', 'waktu_akhir', 'harga'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = DetailTanah::find();

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
            'id_detail' => $this->id_detail,
            'tanah_id' => $this->tanah_id,
            'tanggal_tersedia' => $this->tanggal_tersedia,
            'waktu_awal' => $this->waktu_awal,
            'waktu_akhir' => $this->waktu_akhir,
        ]);

        $query->andFilterWhere(['like', 'harga', $this->harga]);

        return $dataProvider;
    }
}
