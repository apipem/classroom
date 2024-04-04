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
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>nombre</th>
            <th>descripcion</th>
            <th>fechaIncio</th>
            <th>fechaFin</th>
            <?php if (Yii::$app->user->identity->rol == "profesor"){?>
            <th>Acciones</th>
            <?php }?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $proyecto): ?>
            <tr>
                <td><?= $proyecto["nombre"] ?></td>
                <td><?= $proyecto["descripcion"] ?></td>
                <td><?= $proyecto["fechaIncio"] ?></td>
                <td><?= $proyecto["fechaFin"] ?></td>
                <?php if (Yii::$app->user->identity->rol == "profesor"){?>
                <td>
                    <button class="btn btn-warning">Modificar</button>
                    <button class="btn btn-danger">Eliminar</button>
                </td>
                <?php }?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
