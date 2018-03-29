<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contact_phones".
 *
 * @property int $id
 * @property int $contact_id Id контакта
 * @property string $phone_number Номер телефона
 * @property int $created_at Дата создания
 * @property int $updated_at Дата изменения
 *
 * @property Contact $contact
 */
class ContactPhones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_phones';
    }
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contact_id', 'phone_number'], 'required'],
            [['contact_id', 'created_at', 'updated_at'], 'integer'],
            ['phone_number', 'match', 'pattern' => '/^[()0-9-+\s]+$/'],
            [['phone_number'], 'string', 'length' => 17],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contact::className(), 'targetAttribute' => ['contact_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contact_id' => 'Id контакта',
            'phone_number' => 'Номер телефона',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contact::className(), ['id' => 'contact_id']);
    }
}
