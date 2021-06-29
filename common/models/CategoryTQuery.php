<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CategoryT]].
 *
 * @see CategoryT
 */
class CategoryTQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CategoryT[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CategoryT|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
