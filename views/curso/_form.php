<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Curso $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="curso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estudiante')->textInput() ?>

    <?= $form->field($model, 'materia')->textInput() ?>

    <?= $form->field($model, 'profesor')->textInput() ?>

    <?= $form->field($model, 'nota')->textInput() ?>

    <?= $form->field($model, 'notificacion')->textInput() ?>

    <?= $form->field($model, 'notas')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
