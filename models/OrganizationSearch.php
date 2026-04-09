<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Organization;

class OrganizationSearch extends Organization
{
    public function rules() { return [['id', 'integer'], [['name', 'inn', 'kpp', 'ogrn'], 'safe']]; }
    public function scenarios() { return Model::scenarios(); }

    public function search($params)
    {
        $query = Organization::find();
        $dataProvider = new ActiveDataProvider(['query' => $query, 'sort' => ['defaultOrder' => ['id' => SORT_DESC]]]);
        $this->load($params);
        if (!$this->validate()) return $dataProvider;
        $query->andFilterWhere(['id' => $this->id])
              ->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'inn', $this->inn])
              ->andFilterWhere(['like', 'kpp', $this->kpp]);
        return $dataProvider;
    }
}