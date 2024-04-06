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

<div class="container mt-5">
    <h2 class="mb-4">Buscar Material de Apoyo</h2>
    <form class="row g-3" action="<?= Url::to(['notas/filtro']) ?>" method="get">
        <div class="col-md-6">
            <label for="proyecto" class="form-label">Proyecto</label>
            <select class="form-select" id="proyectouser" name="proyecto">
                <option value="0" selected>Selecciona un proyecto</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="materias" class="form-label">Materia</label>
            <select class="form-select" id="materiasuser" name="materia">
                <option value="0" selected>Selecciona una materia</option>
            </select>
        </div>
        <div class="col-12">
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-success">Filtrar</button>
            </div>
        </div>
    </form>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-9">
            <h1>Material de Apoyo</h1>
        </div>
        <div class="col-md-3">
            <?php if (Yii::$app->user->identity->rol == "profesor"): ?>
                <?= Html::a('Agregar Material de Apoyo', ['create'], ['class' => 'btn btn-success']) ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mt-4">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Contenido</th>
                <th>Descripción</th>
                <th>Materia</th>
                <th>Proyecto</th>
                <?php if (Yii::$app->user->identity->rol == "profesor"): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $obj): ?>
                <tr>
                    <td><?= $obj["contenido"] ?></td>
                    <td><?= $obj["descripcion"] ?></td>
                    <td><?= $obj["materia"] ?></td>
                    <td><?= $obj["proyecto"] ?></td>
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
</div>
