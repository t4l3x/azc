<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%phone_numbers}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%category}}`
 */
class m200701_214032_create_phone_numbers_table extends Migration
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

        // creates index for column `cat_id`
        $this->createIndex(
            '{{%idx-phone_numbers-cat_id}}',
            '{{%phone_numbers}}',
            'cat_id'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-phone_numbers-cat_id}}',
            '{{%phone_numbers}}',
            'cat_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%fk-vendor-cat_id}}',
            '{{%phone_numbers}}',
            'vendor_id',
            '{{%vendors}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            '{{%fk-operator-cat_id}}',
            '{{%phone_numbers}}',
            'operator_id',
            '{{%operator}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-phone_numbers-cat_id}}',
            '{{%phone_numbers}}'
        );

        // drops index for column `cat_id`
        $this->dropIndex(
            '{{%idx-phone_numbers-cat_id}}',
            '{{%phone_numbers}}'
        );

        $this->dropTable('{{%phone_numbers}}');
    }
}
