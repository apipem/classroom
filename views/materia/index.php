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
<div class="container">
    <div class="row">
        <div class="col-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-2">
            <div class="container">
                <?php if (Yii::$app->user->identity->rol == "profesor"){?>
                    <p><?= Html::a('Crear Materia', ['create'], ['class' => 'btn btn-success']) ?></p>
                <?php }?>
            </div>
        </div>
    </div>

    <div class="row">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Codigo</th>
                    <th>% corte1</th>
                    <th>% corte2</th>
                    <th>% corte3</th>
                    <?php if (Yii::$app->user->identity->rol == "profesor"){?>
                        <th>acciones</th>
                    <?php }?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $obj): ?>
                    <tr>
                        <td><?=  $obj["nombre"] ?></td>
                        <td><?=  $obj["codigo"] ?></td>
                        <td><?=  $obj["vcorte1"] ?></td>
                        <td><?=  $obj["vcorte2"] ?></td>
                        <td><?=  $obj["vcorte3"] ?></td>


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

