<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Notas $model */

$this->title = 'Create Notas';
$this->params['breadcrumbs'][] = ['label' => 'Notas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
