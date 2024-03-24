<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Contenido $model */

$this->title = 'Update Contenido: ' . $model->idcontenido;
$this->params['breadcrumbs'][] = ['label' => 'Contenidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcontenido, 'url' => ['view', 'idcontenido' => $model->idcontenido]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contenido-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
