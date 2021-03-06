<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ContactPhones;

/**
 * ContactPhonesSearch represents the model behind the search form of `common\models\ContactPhones`.
 */
class ContactPhonesSearch extends ContactPhones
{
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param int $contactId    Id контакта
     * @param array $params     Параметры фильтров, сортировки
     *
     * @return ActiveDataProvider
     */
    public function search(int $contactId, array $params): ActiveDataProvider
    {
        $query = ContactPhones::find()->where(['contact_id' => $contactId]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
            'pagination' => false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
