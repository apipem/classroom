<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Contenido $model */

$this->title = 'Create Contenido';
$this->params['breadcrumbs'][] = ['label' => 'Contenidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contenido-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
