<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "operator".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $prefix
 *
 * @property PhoneNumbers[] $phoneNumbers
 */
class Operator extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prefix'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'prefix' => Yii::t('app', 'Prefix'),
        ];
    }

    /**
     * Gets query for [[PhoneNumbers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneNumbers()
    {
        return $this->hasMany(PhoneNumbers::className(), ['operator_id' => 'id']);
    }
}
