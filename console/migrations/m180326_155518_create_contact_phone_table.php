<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_phone`.
 */
class m180326_155518_create_contact_phone_table extends Migration
{
    const TABLE_NAME = 'contact_phones';
    const TABLE_CONTACT_NAME = 'contact';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'contact_id' => $this->integer()->notNull()->comment('Id контакта'),
            // Не уникальное на случай, если у одного из пользователей оператор заберет номер и продаст другому
            'phone_number' => $this->string(32)->notNull()->comment('Номер телефона'),
            
            'created_at' => $this->integer()->notNull()->comment('Дата создания'),
            'updated_at' => $this->integer()->notNull()->comment('Дата изменения'),
        ]);
        
        $this->createIndex('ind_contact_phones_f_contact_id', self::TABLE_NAME, 'contact_id');
        
        $this->addForeignKey('fk_contact_phones_f_contact_id', self::TABLE_NAME, 'contact_id', self::TABLE_CONTACT_NAME, 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
