<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%phone_numbers}}`.
 */
class m200701_153430_create_phone_numbers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%phone_numbers}}', [
            'id' => $this->primaryKey()->unsigned(),
            'cat_id' => $this->integer()->unsigned(),
            'vendor_id' => $this->integer()->unsigned(),
            'operator_id' => $this->integer()->unsigned(),
            'number' => $this->string(15)
        ]);

//

        $this->createIndex(
            'idx-number',
            'phone_numbers',
            'number'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%phone_numbers}}');
    }
}
