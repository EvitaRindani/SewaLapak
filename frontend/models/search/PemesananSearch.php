<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Pemesanan;

/**
 * PemesananSearch represents the model behind the search form about `frontend\models\Pemesanan`.
 */
class PemesananSearch extends Pemesanan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pemesanan', 'user_id', 'detail_id', 'status', 'status_bayar'], 'integer'],
            [['waktu_pemesanan', 'waktu_penerimaan'], 'safe'],
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
        $query = Pemesanan::find();

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
            'id_pemesanan' => $this->id_pemesanan,
            'user_id' => $this->user_id,
            'detail_id' => $this->detail_id,
            'waktu_pemesanan' => $this->waktu_pemesanan,
            'waktu_penerimaan' => $this->waktu_penerimaan,
            'status' => $this->status,
            'status_bayar' => $this->status_bayar,
        ]);

        return $dataProvider;
    }
}
