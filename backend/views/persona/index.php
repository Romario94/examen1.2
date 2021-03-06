<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Persona', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Reset Saldo', ['reset'], ['class' => 'btn btn-warning']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'uid',
            //'idD',
            [
                'attribute' => 'idD',
                'label' => 'Departamento',
                'value' => function($data) {
                    $dato = common\models\Departamento::find()->where(['idD' => $data['idD']])->one();
                    return $dato->nombreD;
                }
                    ],
                    //'nombreP',
                            [
                'attribute' => 'nombreP',
                'label' => 'Persona',
                'value' => function($data) {
                    $dato = common\models\User::find()->where(['id' => $data['nombreP']])->one();
                    return $dato->username;
                }
                    ],
                    'saldo',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
</div>
