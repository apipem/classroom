<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Iniciar Sesión';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center"><?= Html::encode($this->title) ?></h1>

                <p class="card-text text-center">Por favor, ingrese su número de documento y su contraseña:</p>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class='col-lg-6'>{input}</div>\n<div class='col-lg-6'>{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-6 col-form-label'],
                        'inputOptions' => ['class' => 'form-control', 'style' => 'border-color: #6c757d;'], // Color del contorno (gris)
                        'errorOptions' => ['class' => 'invalid-feedback'],
                    ],
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Número de documento']) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Contraseña']) ?>


                <div class="form-group row">
                    <div class="offset-lg-6 col-lg-6">
                        <div class="d-flex justify-content-between align-items-center">
                            <?= Html::a('Volver', ['site/index'], ['class' => 'btn btn-outline-secondary mt-3']) ?>
                            <?= Html::submitButton('Iniciar Sesión', ['class' => 'btn btn-primary', 'name' => 'login-button', 'style' => 'background-color: #6c757d; border-color: #6c757d;']) ?>
                        </div>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // Capturar el mensaje de "No autorizado" y mostrar una alerta
    $(document).ready(function() {
        if ($('h2:contains("No autorizado")').length > 0) {
            alert("No autorizado");
        }
    });
</script>
