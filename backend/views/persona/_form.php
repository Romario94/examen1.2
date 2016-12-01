<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use mihaildev\elfinder\ElFinder;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">

    <?php $form = ActiveForm::begin(); ?>
    <?=
    $form->field($model, 'idD')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(common\models\Departamento::find()->all(), 'idD', 'nombreD'),
        'language' => 'es',
        'options' => ['placeholder' => 'Elija el Departamento ..'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?> 
    <?=
    $form->field($model, 'nombreP')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(common\models\User::find()->all(), 'id', 'username'),
        'language' => 'es',
        'options' => ['placeholder' => 'Elija la persona ..'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?> 


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
