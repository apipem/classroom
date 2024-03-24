<?php

use app\models\Materia;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\MateriaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Materias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Materia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idmateria',
            'nombre',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Materia $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idmateria' => $model->idmateria]);
                 }
            ],
        ],
    ]); ?>


</div>
