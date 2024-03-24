<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Materia $model */

$this->title = 'Create Materia';
$this->params['breadcrumbs'][] = ['label' => 'Materias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
