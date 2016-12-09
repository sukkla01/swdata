<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FingerDownload;

/**
 * FingerDownloadSearch represents the model behind the search form of `app\models\FingerDownload`.
 */
class FingerDownloadSearch extends FingerDownload
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year', 'month', 'file1', 'file2', 'file3', 'file4', 'note1'], 'safe'],
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
        $query = FingerDownload::find();

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
        $query->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'month', $this->month])
            ->andFilterWhere(['like', 'file1', $this->file1])
            ->andFilterWhere(['like', 'file2', $this->file2])
            ->andFilterWhere(['like', 'file3', $this->file3])
            ->andFilterWhere(['like', 'file4', $this->file4])
            ->andFilterWhere(['like', 'note1', $this->note1]);

        return $dataProvider;
    }
}
