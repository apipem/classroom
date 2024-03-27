<?php

use app\models\Contenido;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ContenidoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Contenidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contenido-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Contenido', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idcontenido',
            'contenido:ntext',
            'descripcion:ntext',
            'materia',
            'proyecto',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Contenido $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idcontenido' => $model->idcontenido]);
                 }
            ],
        ],
    ]); ?>


</div>
