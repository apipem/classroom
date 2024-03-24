<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Proyecto $model */

$this->title = 'Update Proyecto: ' . $model->idProyecto;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idProyecto, 'url' => ['view', 'idProyecto' => $model->idProyecto]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="proyecto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
