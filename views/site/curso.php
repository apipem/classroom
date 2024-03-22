<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Curso $model */
/** @var ActiveForm $form */
?>
<div class="site-curso">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'estudiante') ?>
        <?= $form->field($model, 'materia') ?>
        <?= $form->field($model, 'profesor') ?>
        <?= $form->field($model, 'notas') ?>
        <?= $form->field($model, 'notificacion') ?>
        <?= $form->field($model, 'nota') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-curso -->
