<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%operator}}`.
 */
class m200701_204141_create_operator_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%operator}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(),
            'prefix' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%operator}}');
    }
}
