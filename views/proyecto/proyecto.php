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

    <table class="table">
        <thead>
        <tr>
            <th>data</th>
            <th>Nombre</th>
            <th>campo</th>
            <!-- Agrega más columnas según las propiedades que quieras mostrar -->
        </tr>
        </thead>
        <tbody>
        <?php
        if (is_array($data)) {
            $count = count($data);

            if ($count > 0) {
                echo "El objeto tiene más de un objeto.";
            }
        } else {
            echo "No se pudo obtener los resultados.";
        }?>

        <?php foreach ($data as $proyecto): ?>
            <tr>
                <td><?= print_r($proyecto) ?></td>
                <td><?= print_r($proyecto) ?></td>
                <td><?= print_r($proyecto) ?></td>
                <!-- Agrega más celdas según las propiedades que quieras mostrar -->
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
