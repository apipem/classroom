<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MateriaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="materia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idmateria') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'vcorte1') ?>

    <?= $form->field($model, 'vcorte2') ?>

    <?php // echo $form->field($model, 'vcorte3') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
