<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Materia $model */
/** @var ActiveForm $form */
?>
<div class="site-materia">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'idmateria') ?>
        <?= $form->field($model, 'nombre') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-materia -->
