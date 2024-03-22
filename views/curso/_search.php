<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CursoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="curso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idcurso') ?>

    <?= $form->field($model, 'estudiante') ?>

    <?= $form->field($model, 'materia') ?>

    <?= $form->field($model, 'profesor') ?>

    <?= $form->field($model, 'nota') ?>

    <?php // echo $form->field($model, 'notificacion') ?>

    <?php // echo $form->field($model, 'notas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
