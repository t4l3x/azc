<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 *
 * @property PhoneNumbers[] $phoneNumbers
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $locale;
    public $name;

    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['locale', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * Gets query for [[PhoneNumbers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneNumbers()
    {
        return $this->hasMany(PhoneNumbers::className(), ['cat_id' => 'id']);
    }

    public function translate($id = null)
    {
        $t = self::findOne(['id' => $id]) ?? new Category();
        $this->save();
        $translate = new CategoryT();
        $translate->category_id = $this->getPrimaryKey();
        $translate->locale = Yii::$app->language;
        $translate->name = $this->name;
        if ($translate->save()) {
            return true;
        } else {
            var_dump($translate->errors);
            die();
        }

    }

    public function getTranslations()
    {
        return $this->hasOne(CategoryT::className(), ['category_id' => 'id'])
            ->where(['locale' => Yii::$app->language]);
    }

    public function getTen()
    {
        $query = $this->hasMany(PhoneNumbers::className(), ['cat_id' => 'id'])
            ->joinWith(['operator'], false)
            ->select('operator.prefix as prefix, operator.name as company,phone_numbers.number,phone_numbers.id')
            ->asArray();
        return $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 10,
                'params' => array('my_new_param' => 'myvalue'),
            ]
        ]);
    }
}
