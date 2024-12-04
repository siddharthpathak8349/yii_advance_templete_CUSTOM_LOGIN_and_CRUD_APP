<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m241204_124349_create_book_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'author' => $this->string(255)->notNull(),
            'created_at' => $this->dateTime()->defaultValue(null),
            'created_by' => $this->integer()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
            'updated_by' => $this->integer()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%book}}');
    }
}
