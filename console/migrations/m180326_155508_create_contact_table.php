<?php

use yii\db\Migration;
use Faker\Factory;

/**
 * Handles the creation of table `contact`.
 */
class m180326_155508_create_contact_table extends Migration
{
    const TABLE_NAME = 'contact';
    const COUNT = 50;
    
    public function up()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название контакта'),

            'created_at' => $this->integer()->notNull()->comment('Дата добавления'),
            'updated_at' => $this->integer()->notNull()->comment('Дата изменения'),
        ]);
        
        $faker = Factory::create('ru_RU');
        $rows = [];
        for ($i = 0; $i < self::COUNT; $i++) {
            $time = time();
            $rows[] = [
                'name' => $faker->name,
                'created_at' => $time,
                'updated_at' => $time
            ];
        }
        $this->batchInsert(self::TABLE_NAME, ['name', 'created_at', 'updated_at'], $rows);
    }

    public function down()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
