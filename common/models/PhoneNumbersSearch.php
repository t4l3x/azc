<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PhoneNumbers;

/**
 * PhoneNumbersSearch represents the model behind the search form of `common\models\PhoneNumbers`.
 */
class PhoneNumbersSearch extends PhoneNumbers
{
    /**
     * {@inheritdoc}
     */


    public $category;
    public $vendors;
    public $operator;
    public function rules()
    {
        return [
            [['id', 'cat_id', 'vendor_id', 'operator_id'], 'safe'],
            [['number','category','vendors','operator'], 'safe'],
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
        $query = PhoneNumbers::find();
        $query->joinWith(['operator','vendor','catTranslate'],false);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['catTranslate'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['category_t.name' => SORT_ASC],
            'desc' => ['category_t.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }



        $query->andFilterWhere(['like', 'number', $this->number]);
        $query->andFilterWhere(['like','category_t.name', $this->category]);
        $query->andFilterWhere(['like','operator.prefix', $this->operator]);
        $query->andFilterWhere(['like','vendors.name', $this->vendors]);
        return $dataProvider;
    }
}
