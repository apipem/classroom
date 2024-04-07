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
<div class="container mt-5">
    <div class="row">
        <div class="col-xs-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <!-- Formulario de búsqueda -->
    <?php if (Yii::$app->user->identity->rol == "profesor") : ?>
    <div class="row mt-3">
        <div class="col-xs-12">
            <form action="" method="get" class="row g-3">
                <input type="hidden" name="_csrf" id="token" value="<?= Yii::$app->request->getCsrfToken() ?>">
                <div class="col-md-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="ProyectoSearch[nombre]" placeholder="Nombre">
                </div>
                <div class="col-md-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="descripcion" name="ProyectoSearch[descripcion]" placeholder="Descripción">
                </div>
                <div class="col-md-3">
                    <label for="finicio" class="form-label">Fecha de inicio</label>
                    <input type="date" class="form-control" id="finicio" name="ProyectoSearch[fechaIncio]" placeholder="Fecha de inicio">
                </div>
                <div class="col-md-3">
                    <label for="ffin" class="form-label">Fecha de fin</label>
                    <input type="date" class="form-control" id="ffin" name="ProyectoSearch[fechaFin]" placeholder="Fecha de fin">
                </div>
                <div class="col-md-12 text-end">
                    <button type="button" class="btn btn-success" onclick="proyectosave()">Crear proyecto</button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>
    <!-- Tabla de proyectos -->
    <div class="row mt-3">
        <div class="col-xs-12">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha de fin</th>
                    <?php if (Yii::$app->user->identity->rol == "profesor"): ?>
                        <th>Acciones</th>

                </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $obj): ?>
                    <tr>
                        <td><?= $obj["nombre"] ?></td>
                        <td><?= $obj["descripcion"] ?></td>
                        <td><?= implode('-', array_reverse(explode('-',  $finicio = $obj["fechaIncio"]))) ?></td>
                        <td><?= implode('-', array_reverse(explode('-',  $finicio = $obj["fechaFin"]))) ?></td>

                        <?php if (Yii::$app->user->identity->rol == "profesor") : ?>
                            <td>
                                <form action="<?= Yii::$app->getUrlManager()->createUrl('recurso/deleteproyecto') ?>" method="get">
                                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                                    <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#exampleModal" type="button" onclick="proyectoguardar('<?= $obj["idProyecto"] ?>',1)">Modificar</button>
                                    <button class="btn btn-danger" data-confirm="Estas seguro de eliminar el proyecto: <?= $obj["nombre"] ?> ?">Eliminar</button>
                                    <input type="hidden" name="idproyecto" value="<?= $obj["idProyecto"] ?>">
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajusta los valores del proyecto</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="" method="get" class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre1" name="ProyectoSearch[nombre]" placeholder="Nombre">
                            <input type="text" class="form-control" id="idproyecto1" hidden disabled  name="ProyectoSearch[nombre]" placeholder="Nombre">
                        </div>
                        <div class="col-md-6">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descripcion1" name="ProyectoSearch[descripcion]" placeholder="Descripción">
                        </div>
                        <div class="col-md-6">
                            <label for="finicio" class="form-label">Fecha de inicio</label>
                            <input type="date" class="form-control" id="finicio1" name="ProyectoSearch[fechaIncio]" placeholder="Fecha de inicio">
                        </div>
                        <div class="col-md-6">
                            <label for="ffin" class="form-label">Fecha de fin</label>
                            <input type="date" class="form-control" id="ffin1" name="ProyectoSearch[fechaFin]" placeholder="Fecha de fin">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" onclick="proyectoguardar('0',0)">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
