<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Contenido $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contenido-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'row g-3']
    ]); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'contenido')->fileInput(['name' => 'Contenido[url][]', 'multiple' => true])->label('Contenido') ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'descripcion')->textarea(['rows' => 6])->label('Descripción') ?>
    </div>

    <div class="col-md-6">
        <label for="materias" class="form-label">Materia</label>
        <select class="custom-select" name="Contenido[materia]" id="materias">
            <option selected>Selecciona un proyecto</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="materias" class="form-label">Proyecto</label>
        <select class="custom-select" name="Contenido[proyecto]" id="proyecto">
            <option selected>Selecciona un proyecto</option>
        </select>
    </div>

    <div class="col-md-11">

    </div>
    <div class="col-md-1">
        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
