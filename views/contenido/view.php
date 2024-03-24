<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Contenido $model */

$this->title = $model->idcontenido;
$this->params['breadcrumbs'][] = ['label' => 'Contenidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contenido-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idcontenido' => $model->idcontenido], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idcontenido' => $model->idcontenido], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcontenido',
            'contenido:ntext',
            'descripcion:ntext',
            'materia',
            'proyecto',
        ],
    ]) ?>

</div>
