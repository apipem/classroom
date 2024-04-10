<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Contenido $model */

$this->title = 'Create Contenido';
$this->params['breadcrumbs'][] = ['label' => 'Contenidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contenido-create">

    <?php if (Yii::$app->user->identity->rol == "profesor"): ?>
        <h1>Agregar Material de apoyo</h1>
    <?php else: ?>
        <h1>Subir evidencias</h1>
    <?php endif; ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
