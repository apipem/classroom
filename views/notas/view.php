<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Notas $model */

$this->title = $model->idnotas;
$this->params['breadcrumbs'][] = ['label' => 'Notas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idnotas' => $model->idnotas], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idnotas' => $model->idnotas], [
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
            'idnotas',
            'corte 1',
            'corte 2',
            'corte 3',
            'proyecto',
        ],
    ]) ?>

</div>
