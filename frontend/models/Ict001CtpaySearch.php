<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ict001Ctpay;

/**
 * Ict001CtpaySearch represents the model behind the search form of `app\models\Ict001Ctpay`.
 */
class Ict001CtpaySearch extends Ict001Ctpay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hos_guid', 'vstdate', 'rxdate', 'vn', 'hn', 'an', 'fullname', 'ward', 'wardname', 'dep_code', 'department', 'icode', 'drugname', 'billcode', 'pttype', 'pttypename', 'income', 'paidst', 'reason', 'necessary', 'command_doctor', 'CTstatus'], 'safe'],
            [['qty', 'age_y'], 'integer'],
            [['unitprice', 'sum_price', 'payprice'], 'number'],
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
        $query = Ict001Ctpay::find();

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
            'vstdate' => $this->vstdate,
            'rxdate' => $this->rxdate,
            'qty' => $this->qty,
            'unitprice' => $this->unitprice,
            'sum_price' => $this->sum_price,
            'payprice' => $this->payprice,
            'age_y' => $this->age_y,
        ]);

        $query->andFilterWhere(['like', 'hos_guid', $this->hos_guid])
            ->andFilterWhere(['like', 'vn', $this->vn])
            ->andFilterWhere(['like', 'hn', $this->hn])
            ->andFilterWhere(['like', 'an', $this->an])
            ->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'ward', $this->ward])
            ->andFilterWhere(['like', 'wardname', $this->wardname])
            ->andFilterWhere(['like', 'dep_code', $this->dep_code])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'icode', $this->icode])
            ->andFilterWhere(['like', 'drugname', $this->drugname])
            ->andFilterWhere(['like', 'billcode', $this->billcode])
            ->andFilterWhere(['like', 'pttype', $this->pttype])
            ->andFilterWhere(['like', 'pttypename', $this->pttypename])
            ->andFilterWhere(['like', 'income', $this->income])
            ->andFilterWhere(['like', 'paidst', $this->paidst])
            ->andFilterWhere(['like', 'reason', $this->reason])
            ->andFilterWhere(['like', 'necessary', $this->necessary])
            ->andFilterWhere(['like', 'command_doctor', $this->command_doctor])
            ->andFilterWhere(['like', 'CTstatus', $this->CTstatus]);

        return $dataProvider;
    }
}
