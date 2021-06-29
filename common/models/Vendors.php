<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vendors".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $address
 * @property float|null $latitude
 * @property float|null $longitude
 *
 * @property PhoneNumbers[] $phoneNumbers
 */
class Vendors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['latitude', 'longitude'], 'number'],
            [['name'], 'string', 'max' => 60],
            [['address'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
        ];
    }

    /**
     * Gets query for [[PhoneNumbers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneNumbers()
    {
        return $this->hasMany(PhoneNumbers::className(), ['vendor_id' => 'id']);
    }
}
