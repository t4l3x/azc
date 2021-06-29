<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_t}}`.
 */
class m200701_205239_create_category_t_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_t}}', [
            'category_id' => $this->integer()->unsigned(),
            'locale' => $this->string(),
            'name' => $this->string()
        ]);
        $this->addPrimaryKey('', '{{%category_t}}', ['category_id', 'locale']);
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category_t}}');
    }
}
