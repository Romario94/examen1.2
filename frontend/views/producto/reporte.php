<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos Consumidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Comprar Producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="row">
        <div class="pull-left">
            
        </div>
        <div class="pull-right">
            <b><h2>TOTAL</h2></b>
        </div>
    </div>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idP',
            //'nombreP',
            'cantidad',
            [
                'attribute' => 'uid',
                'label' => 'Precio',
                'value' => function($data) {
                    $precio = common\models\Producto::find()->where(['idP' => $data['idP']])->one();
                    return $precio->precio;
                }
                    ],
                    [
                        'attribute' => 'uid',
                        'label' => 'Subtotal',
                        'value' => function($data) {
                            $precio = common\models\Producto::find()->where(['idP' => $data['idP']])->one();
                            return $precio->precio * $data['cantidad'];
                        }
                            ]
                        // 'uid',
                        //['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
    
    
</div>
