<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\NotasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="notas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idnotas') ?>

    <?= $form->field($model, 'corte 1') ?>

    <?= $form->field($model, 'corte 2') ?>

    <?= $form->field($model, 'corte 3') ?>

    <?= $form->field($model, 'proyecto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
