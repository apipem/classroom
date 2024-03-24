<?php

use app\models\Proyecto;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ProyectoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Proyecto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idProyecto',
            'nombre',
            'descripcion:ntext',
            'fechaIncio',
            'fechaFin',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Proyecto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idProyecto' => $model->idProyecto]);
                 }
            ],
        ],
    ]); ?>


</div>
