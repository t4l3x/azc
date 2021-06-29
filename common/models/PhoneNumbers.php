<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phone_numbers".
 *
 * @property int $id
 * @property int|null $cat_id
 * @property int|null $vendor_id
 * @property int|null $operator_id
 * @property string|null $number
 *
 * @property Orders[] $orders
 * @property Operator $operator
 * @property Category $cat
 * @property Vendors $vendor
 */
class PhoneNumbers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phone_numbers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_id', 'vendor_id', 'operator_id'], 'integer'],
            [['number'], 'safe', ],
            [['operator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Operator::className(), 'targetAttribute' => ['operator_id' => 'id']],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_id' => 'id']],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendors::className(), 'targetAttribute' => ['vendor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cat_id' => Yii::t('app', 'Cat ID'),
            'vendor_id' => Yii::t('app', 'Vendor ID'),
            'operator_id' => Yii::t('app', 'Operator ID'),
            'number' => Yii::t('app', 'Number'),
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['phone_id' => 'id']);
    }

    /**
     * Gets query for [[Operator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOperator()
    {
        return $this->hasOne(Operator::className(), ['id' => 'operator_id']);
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Category::className(), ['id' => 'cat_id']);
    }

    public function getCatTranslate()
    {
        return $this->hasOne(CategoryT::className(), ['category_id' => 'cat_id'])->where(['locale' => Yii::$app->language]);
    }
    /**
     * Gets query for [[Vendor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVendor()
    {
        return $this->hasOne(Vendors::className(), ['id' => 'vendor_id']);
    }
}
