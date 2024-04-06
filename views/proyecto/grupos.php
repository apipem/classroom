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
<?php if (Yii::$app->user->identity->rol == "profesor"): ?>
    <div class="container mt-5">
        <h2 class="mb-3">Asignación de Proyecto</h2>
        <form class="row g-3">
            <div class="col-md-6">
                <label for="estudiantes" class="form-label">Estudiante</label>
                <select class="form-select" id="estudiantes">
                    <option selected>Selecciona un estudiante</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="proyecto" class="form-label">Proyecto</label>
                <select class="form-select" id="proyecto">
                    <option selected>Selecciona un proyecto</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="materias" class="form-label">Materia</label>
                <select class="form-select" multiple aria-label="multiple select example" id="materias">
                    <option selected>Selecciona las Materias</option>
                </select>
            </div>
            <div class="col-12 mt-3">
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" onclick="materiaprofesor()" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
<?php endif; ?>

<div class="container">
    <div class="proyecto-index mt-5">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Proyecto</th>
                <th>Estudiante</th>
                <?php if (Yii::$app->user->identity->rol == "profesor"): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $proyecto) : ?>
                <tr>
                    <td><?= $proyecto["nombre_proyecto"] ?></td>
                    <td><?= $proyecto["nombre_estudiante"] ?></td>
                    <?php if (Yii::$app->user->identity->rol == "profesor") : ?>
                        <td>
                            <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" onclick="proyectoestudiante('<?= $proyecto["id"] ?>','<?= $proyecto["nombre_proyecto"] ?>', '<?= $proyecto["nombre_estudiante"] ?>', '1','<?= $proyecto["nombre_proyecto"] ?>')" class="btn btn-warning">Editar</button>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Elige el proyecto del estudiante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="estudiante1" class="form-label">Estudiante</label>
                            <select class="form-select" id="estudiante1" disabled></select>
                        </div>
                        <div class="col-md-6">
                            <label for="proyectoafter" class="form-label">Proyecto actual</label>
                            <select class="form-select" id="proyectoafter" disabled></select>
                        </div>
                        <div class="col-md-6">
                            <label for="proyecto1" class="form-label">Proyecto nuevo</label>
                            <select class="form-select" id="proyecto1">
                                <option selected>Selecciona un proyecto</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" onclick="proyectoestudiante(null,null,null,'0',null)">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Incluye Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
