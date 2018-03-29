<?php

use yii\db\Migration;
use common\models\Contact;
use Faker\Factory;

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
        
        $faker = Factory::create('ru_RU');
        $rows = [];
        $contacts = Contact::find()->all();
        foreach ($contacts as $contact) {
            $phonesCount = rand(0, 5);
            for ($i = 0; $i < $phonesCount; $i++) {
                $date = date_create();
                $time = $faker->dateTimeBetween(date_timestamp_set($date, $contact->created_at))->getTimestamp();
                $rows[] = [
                    'contact_id' => $contact->id,
                    'phone_number' => '+7 (' . $faker->regexify('\[0-9]{3}') . ') ' . $faker->regexify('\[0-9]{3}-[0-9]{4}'),
                    'created_at' => $time,
                    'updated_at' => $time
                ];
            }
        }
        $this->batchInsert(self::TABLE_NAME, ['contact_id', 'phone_number', 'created_at', 'updated_at'], $rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
