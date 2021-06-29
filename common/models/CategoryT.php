<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_t".
 *
 * @property int $category_id
 * @property string $locale
 * @property string|null $name
 */
class CategoryT extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_t';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'locale'], 'required'],
            [['category_id'], 'integer'],
            [['locale', 'name'], 'string', 'max' => 255],
            [['category_id', 'locale'], 'unique', 'targetAttribute' => ['category_id', 'locale']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('app', 'Category ID'),
            'locale' => Yii::t('app', 'Locale'),
            'name' => Yii::t('app', 'Name'),
        ];
    }
}
