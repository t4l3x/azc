<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m200701_201413_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey()->unsigned(),
            'created_at' => $this->integer()->unsigned(),
            'expire_at' => $this->integer()->unsigned(),
            'phone_id' => $this->integer()->unsigned(),
            'verify_code' => $this->integer()->unsigned(),
            'customer_phone' => $this->string(15)
        ]);

        $this->addForeignKey(
            '{{%fk-orders-cat_id}}',
            'orders',
            '{{%phone_id}}',
            '{{%phone_numbers}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
