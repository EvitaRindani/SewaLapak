<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Tanah;

/**
 * TanahSearch represents the model behind the search form about `frontend\models\Tanah`.
 */
class TanahSearch extends Tanah
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tanah'], 'integer'],
            [['nama_pemilik', 'foto_pemilik', 'no_hp_pemilik', 'no_rekening_pemilik', 'alamat_tanah', 'gambar_tanah', 'kota', 'kabupaten'], 'safe'],
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
        $query = Tanah::find();

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
            'id_tanah' => $this->id_tanah,
        ]);

        $query->andFilterWhere(['like', 'nama_pemilik', $this->nama_pemilik])
            ->andFilterWhere(['like', 'foto_pemilik', $this->foto_pemilik])
            ->andFilterWhere(['like', 'no_hp_pemilik', $this->no_hp_pemilik])
            ->andFilterWhere(['like', 'no_rekening_pemilik', $this->no_rekening_pemilik])
            ->andFilterWhere(['like', 'alamat_tanah', $this->alamat_tanah])
            ->andFilterWhere(['like', 'gambar_tanah', $this->gambar_tanah])
            ->andFilterWhere(['like', 'kota', $this->kota])
            ->andFilterWhere(['like', 'kabupaten', $this->kabupaten]);

        return $dataProvider;
    }
}
