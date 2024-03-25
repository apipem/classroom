<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Proyecto $model */

$this->title = $model->idProyecto;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="proyecto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idProyecto' => $model->idProyecto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idProyecto' => $model->idProyecto], [
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
            //'idProyecto',
            'nombre',
            'descripcion:ntext',
            'fechaIncio',
            'fechaFin',
        ],
    ]) ?>

</div>
