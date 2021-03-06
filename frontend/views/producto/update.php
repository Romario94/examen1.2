<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Producto */

$this->title = 'Update Producto: ' . $model->idP;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idP, 'url' => ['view', 'id' => $model->idP]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="producto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
