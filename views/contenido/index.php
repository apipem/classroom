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
<div class="container">
    <div class="row">
        <div class="col-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-2">
            <div class="container">
                <?php if (Yii::$app->user->identity->rol == "profesor"){?>
                    <?= Html::a('Create Proyecto', ['create'], ['class' => 'btn btn-success']) ?>
                <?php }?>
            </div>
        </div>
    </div>

    <div class="row">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <?php if (Yii::$app->user->identity->rol == "profesor"){?>
                    <th>acciones</th>
                <?php }?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $obj): ?>
                <tr>
                    <td><?=  print_r($obj) ?></td>

                    <?php if (Yii::$app->user->identity->rol == "profesor"): ?>
                        <td>
                            <button class="btn btn-warning">Modificar</button>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="row">

    </div>
</div>

