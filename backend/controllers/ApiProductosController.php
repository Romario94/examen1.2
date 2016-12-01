<?php

namespace backend\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;

class ApiProductosController extends ActiveController {

    public $modelClass = 'common\models\Producto';

    public function actions() {
        return array_merge(
                parent::actions(), [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'prepareDataProvider' => function ($action) {
            /* @var $model Post */
            $model = new $this->modelClass;
            $query = $model::find();
            $dataProvider = new ActiveDataProvider(['query' => $query]);
            $model->setAttribute('idP', @$_GET['idP']);
            $model->setAttribute('nombreP', @$_GET['nombreP']);
            $query->andFilterWhere(['like', 'idP', $model->idP]);
            $query->andFilterWhere(['like', 'nombreP', $model->nombreP]);
            return $dataProvider;
        }
            ]
                ]
        );
    }

}
