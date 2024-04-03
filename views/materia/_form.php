<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Materia $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="materia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vcorte1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vcorte2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vcorte3')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
