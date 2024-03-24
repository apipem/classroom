<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ContenidoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contenido-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idcontenido') ?>

    <?= $form->field($model, 'contenido') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'materia') ?>

    <?= $form->field($model, 'proyecto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
