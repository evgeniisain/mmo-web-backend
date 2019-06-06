<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m190605_145146_create_user_table extends Migration
{
    protected $tableName = 'users';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id'       => $this->primaryKey(),
            'login'    => 'TEXT NOT NULL',
            'password' => 'CHARACTER VARYING(40)',
            'email'    => 'TEXT NOT NULL',
        ]);

        $this->createIndex('idx-unique-login', $this->tableName, ['login'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
