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
    <form class="row g-3" action="<?= Yii::$app->getUrlManager()->createUrl('contenido/index') ?>" method="get">
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
    <?php if (Yii::$app->user->identity->rol == "profesor"): ?>
        <div class="row">
            <div class="col-md-9">
                <h1>Material de Apoyo</h1>
            </div>
            <div class="col-md-3">
                <?= Html::a('Agregar Material de Apoyo', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-10">
                <h1>Material de Apoyo</h1>
            </div>
            <div class="text-end col-md-2">
                <?= Html::a('Subir entregables', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="row mt-4">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Contenido</th>
                <th>Proyecto</th>
                <th>Materia</th>
                <th>Propietario</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $obj): ?>
                <tr>
                    <td>
                        <a href="<?= Yii::$app->getUrlManager()->createUrl($obj["contenido"]) ?>" class="btn text-end btn-secondary" download>Descargar</a>
                        <?= explode('/', $obj["contenido"])[1] ?>
                    </td>
                    <td><?= $obj->proyecto0->nombre ?><input type="hidden" value="<?= $obj["proyecto"]?>"></td>
                    <td><?= $obj->materia0->nombre ?><input type="hidden" value="<?= $obj["materia"]?>"></td>
                    <td><?= $obj->user0->nombre.' '.$obj->user0->apellido.'<br> <span style="opacity: 0.4;">('.$obj->user0->rol.')</span> ' ?></td>
                    <td><?= $obj["descripcion"] ?></td>
                    <?php if (Yii::$app->user->identity->id ==  $obj["user"]): ?>
                        <td>
                            <form action="<?= Yii::$app->getUrlManager()->createUrl('recurso/deleterecurso') ?>" method="get">
                                <input type="hidden" value="<?= $obj["idcontenido"]?>">
                                <input type="hidden" name="_csrf"  id="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                                <button data-bs-toggle="modal" data-bs-target="#s" type="button" onclick="proyectoestudiante(<?= $obj["idcontenido"] ?>)" class="btn btn-warning btn-editar">Modificar</button>
                                <button class="btn btn-danger" data-confirm="Estas seguro de eliminar el proyecto: <?= $obj["contenido"] ?> ?">Eliminar</button>
                                <input type="hidden" name="idcontenidodel" value="<?= $obj["idcontenido"] ?>">
                            </form>
                        </td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>


<div class="modal" id="modalEditar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formularioEditar">
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="contenido" class="form-label">Contenido</label>
                            <input type="text" class="form-control" disabled id="contenido" name="contenido">
                            <input type="text" hidden class="form-control" disabled id="idcontenido1" name="idcontenido1">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="materia" class="form-label">Materia</label>
                            <select class="form-select materiasuserupdate" id="" name="materia">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="proyecto" class="form-label">Proyecto</label>
                            <select class="form-select proyectouserupdate" id="" name="proyecto">
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success" >Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>