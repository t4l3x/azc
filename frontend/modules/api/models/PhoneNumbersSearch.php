<?php

namespace frontend\modules\api\models;

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

    public $phone;
    private $numReg;


    public function rules()
    {
        return [
            [['id', 'cat_id', 'vendor_id', 'operator_id'], 'integer'],
            [['phone'], 'safe'],
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
        $query->select('phone_numbers.id,phone_numbers.number,operator.prefix,category_t.name');
        $query->asArray();


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

        $regex = false;
        if(isset($this->phone) && count($this->phone) == 7){
            foreach ($this->phone as $num){
                if(is_numeric($num)){
                    $regex = true;
                    $this->numReg .= $num;
                }else{
                    $this->numReg .= '.';
                }
            }
        }
        if (!$this->validate()) {
            return $dataProvider;
        }
        if($regex){
            $query->andFilterWhere([
               'REGEXP' , 'number', '^'.$this->numReg.'$'
            ]);
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'cat_id' => $this->cat_id,
            'operator_id' => $this->operator_id
        ]);

        $query->andFilterWhere(['like', 'number', $this->number]);
//        $query->andFilterWhere(['like','category_t.name', $this->category]);
//        $query->andFilterWhere(['like','operator.prefix', $this->operator]);
//        $query->andFilterWhere(['like','vendors.name', $this->vendors]);

        return $dataProvider;
    }
}
