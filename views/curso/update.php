<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Curso $model */

$this->title = 'Update Curso: ' . $model->idcurso;
$this->params['breadcrumbs'][] = ['label' => 'Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcurso, 'url' => ['view', 'idcurso' => $model->idcurso]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="curso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
