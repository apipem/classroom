<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Curso $model */

$this->title = $model->idcurso;
$this->params['breadcrumbs'][] = ['label' => 'Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="curso-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idcurso' => $model->idcurso], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idcurso' => $model->idcurso], [
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
            'idcurso',
            'estudiante',
            'materia',
            'profesor',
            'nota',
            'notificacion',
            'notas',
        ],
    ]) ?>

</div>
