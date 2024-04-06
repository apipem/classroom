<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\MateriaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Materias';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container mt-5">
    <?php if (Yii::$app->user->identity->rol == "profesor") : ?>
        <h2 class="mb-4">Agregar una nueva materia</h2>
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="materia-nombre" class="form-label">Nombre</label>
                            <input type="text" id="materia-nombre" class="form-control" name="Materia[nombre]" maxlength="45" required>
                        </div>
                        <div class="col-md-6">
                            <label for="materia-codigo" class="form-label">Código</label>
                            <input type="text" id="materia-codigo" class="form-control" name="Materia[codigo]" maxlength="45">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="materia-vcorte1" class="form-label">Valor corte 1 <span style="opacity: 50%"> %</span> </label>
                            <input type="number" id="materia-vcorte1" class="form-control" name="Materia[vcorte1]" maxlength="45" min="0">
                        </div>
                        <div class="col-md-4">
                            <label for="materia-vcorte2" class="form-label">Valor corte 2 <span style="opacity: 50%"> %</span> </label>
                            <input type="number" id="materia-vcorte2" class="form-control" name="Materia[vcorte2]" maxlength="45" min="0">
                        </div>
                        <div class="col-md-4">
                            <label for="materia-vcorte3" class="form-label">Valor corte 3 <span style="opacity: 50%"> %</span> </label>
                            <input type="number" id="materia-vcorte3" class="form-control" name="Materia[vcorte3]" maxlength="45" min="0">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" onclick="materiaguardar()">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <div class="row mb-4">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>% Corte 1</th>
                    <th>% Corte 2</th>
                    <th>% Corte 3</th>
                    <?php if (Yii::$app->user->identity->rol == "profesor") : ?>
                        <th>Acciones</th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $obj) : ?>
                    <tr>
                        <td><?= $obj["nombre"] ?></td>
                        <td><?= $obj["codigo"] ?></td>
                        <td><?= $obj["vcorte1"] ?></td>
                        <td><?= $obj["vcorte2"] ?></td>
                        <td><?= $obj["vcorte3"] ?></td>

                        <?php if (Yii::$app->user->identity->rol == "profesor") : ?>
                            <td>
                                <form action="<?= Yii::$app->getUrlManager()->createUrl('recurso/deletemateria') ?>" method="get">
                                    <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" onclick="materiasave('<?= $obj["idmateria"] ?>',1)">Modificar</button>
                                    <button class="btn btn-danger" data-confirm="Estas seguro de eliminar la materia: <?= $obj["nombre"] ?> con codigo:  <?= $obj["codigo"] ?> ?">Eliminar</button>
                                    <input type="text" hidden name="idmateria" value="<?= $obj["idmateria"] ?>">
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
                <h5 class="modal-title" id="exampleModalLabel">Ajusta los valores de la materia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= Url::to(['materia/create']) ?>" method="post">
                                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="materia-nombre" class="form-label">Nombre</label>
                                        <input type="text" id="materia-0" class="form-control"disabled hidden name="Materia[1]" maxlength="45">
                                        <input type="text" id="materia-1" class="form-control" name="Materia[1]" maxlength="45" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="materia-codigo" class="form-label">Código</label>
                                        <input type="text" id="materia-2" class="form-control" name="Materia[2]" maxlength="45">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <label for="materia-vcorte1" class="form-label">Valor corte 1 <span style="opacity: 50%"> %</span> </label>
                                        <input type="number" id="materia-3" class="form-control" name="Materia[3]" maxlength="45" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="materia-vcorte2" class="form-label">Valor corte 2 <span style="opacity: 50%"> %</span> </label>
                                        <input type="number" id="materia-4" class="form-control" name="Materia[4]" maxlength="45" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="materia-vcorte3" class="form-label">Valor corte 3 <span style="opacity: 50%"> %</span> </label>
                                        <input type="number" id="materia-5" class="form-control" name="Materia[5]" maxlength="45" min="0">
                                        <input type="hidden" id="token" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" onclick="materiasave('0',0)">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
