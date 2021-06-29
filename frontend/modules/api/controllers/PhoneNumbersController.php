<?php

namespace frontend\modules\api\controllers;

use common\models\Category;
use common\models\Operator;
use common\models\PhoneNumbers;
use common\models\Vendors;
use frontend\modules\api\models\PhoneNumbersSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;

/**
 * Default controller for the `api` module
 */
class PhoneNumbersController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $modelClass = 'frontend\modules\api\models\PhoneNumbers';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'phone-numbers',
    ];

    public function behaviors()

    {

        return [

            [

                'class' => \yii\filters\ContentNegotiator::className(),


                'formats' => [

                    'application/json' => \yii\web\Response::FORMAT_JSON,

                ],

            ],

        ];
    }

    public function actionIndex()
    {
        $items = [];
        $category = Category::find();
        if (Yii::$app->request->get('cat') && is_numeric(Yii::$app->request->get('cat'))) {
            $category = $category->where(['id' => Yii::$app->request->get('cat')]);
        }
        $category = $category->all();
        foreach ($category as $key => $item) {
            $items[$item->translations->name ?? $key] = call_user_func(function () use ($item) {
                $query = PhoneNumbers::find()->where(['cat_id' => $item->id])->joinWith(['operator'], false)
                    ->select('operator.prefix as prefix, operator.name as company,phone_numbers.number,phone_numbers.id')
                    ->asArray();

                return $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => [
                        'defaultPageSize' => 10,
                        'params' => ['cat' => $item->id,'page'=>Yii::$app->request->get('page')],
                    ]
                ]);
            });
        }
        return $items;
    }

    public function actionCategories()
    {
        $category = Category::find()->joinWith(['translations'], false)
            ->select('id,category_t.name')
            ->asArray()
            ->all();
        return $category;
    }

    public function actionPrefix()
    {
        $prefix = Operator::find()
            ->asArray()
            ->all();
        return $prefix;
    }

    public function actionFilter()
    {
        $searchModel = new PhoneNumbersSearch();
        return [Yii::t('app','Results')=>$searchModel->search(Yii::$app->request->queryParams)];
    }

    public function actionVendors()
    {
        return Vendors::find()->select('address,latitude,longitude,id')->asArray()->all();
    }

    public function actionOrder(){
        return ['status' => Yii::t('app','Your order has been successfully verified')];
    }
    // SELECT * FROM `phone_numbers` WHERE  `number`  REGEXP '^...69..$';
//    SELECT * FROM `phone_numbers` WHERE  `number`  REGEXP '[3]{1}[0-9]{1}[0-9]{1}[0-9]{1}[0-9]{1}[4]{1}[8]{1}'
}
