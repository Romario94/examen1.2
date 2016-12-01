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

    <h1><?= Html::encode($this->title) ?></h1><b><h2>TOTAL DE DEUDA: $ <?=$persona->saldo?></b></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Comprar Producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
