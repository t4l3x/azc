<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vendors}}`.
 */
class m200701_155739_create_vendors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vendors}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(60),
            'address' => $this->string(200),
            'latitude' => $this->decimal(10,8),
            'longitude' => $this->decimal(11,8)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vendors}}');
    }
}
