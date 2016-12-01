<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Producto */

$this->title = $model->idP;

?>
<div class="producto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idP',
            'nombreP',
            'precio',
            //'uid',
            //'cantidadC',
        ],
    ]) ?>

</div>
