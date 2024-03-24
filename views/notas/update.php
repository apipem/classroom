<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Notas $model */

$this->title = 'Update Notas: ' . $model->idnotas;
$this->params['breadcrumbs'][] = ['label' => 'Notas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idnotas, 'url' => ['view', 'idnotas' => $model->idnotas]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
