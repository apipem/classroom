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
    <h2 class="mt-5 mb-3">Buscar Material de apoyo</h2>
    <form class="row g-3" action="<?= Yii::$app->getUrlManager()->createUrl('notas/filtro') ?>" method="get">
        <div class="col-md-6">
            <label for="proyecto" class="form-label">Proyecto</label>
            <select class="custom-select" id="proyectouser" name="proyecto">
                <option value="0" selected>Selecciona un proyecto</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="materias" class="form-label">Materia</label>
            <select  value="0" class="custom-select" id="materiasuser" name="materia">
                <option value="0" selected>Selecciona una materia</option>
            </select>
        </div>
        <div class="col-12">
        </div>
        <div class="col-12">
            <div class="text-right mb-3">
                <button type="submit" class="btn btn-success">Filtrar</button>
            </div>
        </div>
    </form>
</div>

<div class="container">
    <div class="row">
        <div class="col-9">
            <h1>Material de apoyo</h1>
        </div>
        <div class="col-3">
            <div class="container">
                <?php if (Yii::$app->user->identity->rol == "profesor"){?>
                    <?= Html::a('Agregar Material de apoyo', ['create'], ['class' => 'btn btn-success']) ?>
                <?php }?>
            </div>
        </div>
    </div>

    <div class="row">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>contenido</th>
                <th>descripcion</th>
                <th>materia</th>
                <th>proyecto</th>
                <?php if (Yii::$app->user->identity->rol == "profesor"){?>
                    <th>acciones</th>
                <?php }?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $obj): ?>
                <tr>
                    <td><?=  $obj["contenido"] ?></td>
                    <td><?=  $obj["descripcion"] ?></td>
                    <td><?=  $obj["materia"] ?></td>
                    <td><?=  $obj["proyecto"] ?></td>

                    <?php if (Yii::$app->user->identity->rol == "profesor"): ?>
                        <td>
                            <button class="btn btn-warning">Modificar</button>
                            <button class="btn btn-danger">Eliminar</button>
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

