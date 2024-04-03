<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Materia $model */

$this->title = $model->idmateria;
$this->params['breadcrumbs'][] = ['label' => 'Materias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="materia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idmateria' => $model->idmateria], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idmateria' => $model->idmateria], [
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
            'idmateria',
            'nombre',
            'codigo',
            'vcorte1',
            'vcorte2',
            'vcorte3',
        ],
    ]) ?>

</div>
