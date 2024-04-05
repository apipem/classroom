<?php

use app\models\Notas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\NotasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Notas';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->user->identity->rol == "profesor"){?>
    <div class="container">
        <h2 class="mt-5 mb-3">Filtrar</h2>
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
<?php }?>
<div class="container">
    <h2 class="mt-5 mb-3">Notas</h2>
    <div class="proyecto-index">

        <?php $rol = Yii::$app->user->identity->rol == "profesor"; ?>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Proyecto</th>
                <th>Materia</th>
                <?php if ($rol){?>
                    <th>Estudiante</th>
                <?php }?>
                <th>Corte <span style="font-weight: bold;">1</span> <span style="opacity: 0.6;">(%)</span></th>
                <th>Corte <span style="font-weight: bold;">2</span> <span style="opacity: 0.6;">(%)</span></th>
                <th>Corte <span style="font-weight: bold;">3</span> <span style="opacity: 0.6;">(%)</span></th>
                <th>Final <span style="font-weight: bold;">3</span> <span style="opacity: 0.6;">(%)</span></th>

                <?php if ($rol){?>
                    <th>Acciones</th>
                <?php }?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($notas as $proyecto): ?>
                <tr>
                    <td><?=  $proyecto["nombre_proyecto"] ?></td>
                    <td><?=  $proyecto["nombre_materia"] ?></td>
                    <?php if ($rol){?>
                        <td><?=  $proyecto["nombre_estudiante"] ?></td>
                    <?php }?>
                    <td><?=  $proyecto["corte1"] ?> <span style="opacity: 0.6;">(<?=  $proyecto["vcorte1"] ?> %)</span> </td>
                    <td><?=  $proyecto["corte2"] ?> <span style="opacity: 0.6;">(<?=  $proyecto["vcorte2"] ?> %)</span> </td>
                    <td><?=  $proyecto["corte3"] ?> <span style="opacity: 0.6;">(<?=  $proyecto["vcorte3"] ?> %)</span> </td>
                    <td><?=  $proyecto["nota"] ?> <span style="opacity: 0.6;">(100 %)</span> </td>

                    <?php if ($rol): ?>
                        <td>
                            <form action="<?= Yii::$app->getUrlManager()->createUrl('recurso/deletecurso') ?>" method="get">

                                <input type="text" hidden name="idcurso" value="<?=  $proyecto["idcurso"] ?>">
                                <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" onclick="preupdatenotas(<?= $proyecto["idcurso"] ?>,false)" class="btn btn-warning">Editar</button>
                                <button class="btn btn-danger" data-confirm="Estas  seguro de eliminar el estudiante <?=  $proyecto["nombre_estudiante"] ?>?">Eliminar</button>
                            </form>


                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verifique las notas antes de enviarlas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="proyecto" class="form-label">Proyecto</label>
                            <select class="custom-select" id="proyectonotas" disabled name="proyecto">

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="materias" class="form-label">Materia</label>
                            <select  value="0" class="custom-select" id="materiasnotas" disabled name="materia">

                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="materias" class="form-label">Estudiante</label>
                            <select  value="0" class="custom-select" id="estudiantenotas" disabled name="estudiante">

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="materias" class="form-label">corte1</label>
                            <input type="number" class="form-control" id="corte1" placeholder="">
                            <label for="materias" class="form-label">%</label>
                            <input type="number" disabled class="form-control" id="materiacorte1" placeholder="">
                        </div>
                        <div class="col-md-3">
                            <label for="materias" class="form-label">corte2</label>
                            <input type="number" class="form-control" id="corte2" placeholder="">
                            <label for="materias" class="form-label">%</label>
                            <input type="number"disabled class="form-control" id="materiacorte2" placeholder="">
                        </div>
                        <div class="col-md-3">
                            <label for="materias" class="form-label">corte3</label>
                            <input type="number" class="form-control" id="corte3" placeholder="">
                            <label for="materias" class="form-label">%</label>
                            <input type="number" disabled class="form-control" id="materiacorte3" placeholder="">
                        </div>
                        <div class="col-md-3">
                            <label for="materias" class="form-label">final</label>
                            <input type="number" disabled class="form-control" id="final" placeholder="">
                            <label for="materias" class="form-label">%</label>
                            <input type="text" disabled class="form-control" value="100%" placeholder="">
                            <input type="number" disabled hidden class="form-control" id="idnotas" placeholder="">
                            <input type="number" disabled hidden class="form-control" id="idcurso" placeholder="">
                        </div>
                        
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" onclick="preupdatenotas(null,true)">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Incluye Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
