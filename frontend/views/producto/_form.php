<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-6">
        <?= $form->field($modelRegistro, 'idP')->dropDownList($model->ComboProductos, ['prompt' => 'Elija...']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($modelRegistro, 'cantidad')->textInput() ?>
    </div>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        'columns' => [

            'nombreP',
            'precio',
            //'uid',
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($modelRegistro->isNewRecord ? 'Create' : 'Update', ['class' => $modelRegistro->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
