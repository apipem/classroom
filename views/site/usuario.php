<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Usuario $model */
/** @var ActiveForm $form */
?>
<div class="site-usuario">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'cc') ?>
        <?= $form->field($model, 'nombre') ?>
        <?= $form->field($model, 'apellido') ?>
        <?= $form->field($model, 'correo') ?>
        <?= $form->field($model, 'contrasena') ?>
        <?= $form->field($model, 'rol') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-usuario -->
