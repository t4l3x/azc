<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int|null $created_at
 * @property int|null $expire_at
 * @property int|null $phone_id
 * @property int|null $verify_code
 * @property string|null $customer_phone
 *
 * @property PhoneNumbers $phone
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'expire_at', 'phone_id', 'verify_code'], 'integer'],
            [['customer_phone'], 'string', 'max' => 15],
            [['phone_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhoneNumbers::className(), 'targetAttribute' => ['phone_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'expire_at' => Yii::t('app', 'Expire At'),
            'phone_id' => Yii::t('app', 'Phone ID'),
            'verify_code' => Yii::t('app', 'Verify Code'),
            'customer_phone' => Yii::t('app', 'Customer Phone'),
        ];
    }

    /**
     * Gets query for [[Phone]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhone()
    {
        return $this->hasOne(PhoneNumbers::className(), ['id' => 'phone_id']);
    }
}
