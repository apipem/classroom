<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Notas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="notas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'corte 1')->textInput() ?>

    <?= $form->field($model, 'corte 2')->textInput() ?>

    <?= $form->field($model, 'corte 3')->textInput() ?>

    <?= $form->field($model, 'proyecto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
