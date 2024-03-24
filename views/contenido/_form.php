<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Contenido $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contenido-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idcontenido')->textInput() ?>

    <?= $form->field($model, 'contenido')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'materia')->textInput() ?>

    <?= $form->field($model, 'proyecto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
