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
<head>
    <title>Title</title>
    <?php $this->head() ?>
    <?= Html::csrfMetaTags() ?> <!-- Agrega esto en tu head -->
</head>
<?php if (Yii::$app->user->identity->rol == "profesor"){?>
<div class="container">
    <h2 class="mb-4">Agregar una nueva materia</h2>
    <div class="card">
        <div class="card-body">
            <form action="/classroom/web/materia/create" method="post">
                <input type="hidden" name="_csrf" value="d8x4lXLj1lecRiy5r3EoADl__cMqOoQ5WbosuUcLWwQBnEygB7CaNfElZJT-IUBRUhKirWZL3nMG7mnxDlFpXA==">
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
                    <div class="col-md-10">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php }?>
<div class="container">
    <div class="row mb-4">
        <div class="col-md-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-2 text-end">
            <?php if (Yii::$app->user->identity->rol == "profesor"): ?>
                <?= Html::a('Crear Materia', ['create'], ['class' => 'btn btn-success']) ?>
            <?php endif; ?>
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
                    <?php if (Yii::$app->user->identity->rol == "profesor"): ?>
                        <th>Acciones</th>
                    <?php endif; ?>
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
                                <form action="<?= Yii::$app->getUrlManager()->createUrl('recurso/deletemateria') ?>" method="get">
                                    <button class="btn btn-warning">Modificar</button>
                                    <button class="btn btn-danger" data-confirm="Estas  seguro de eliminar el estudiante <?=  $obj["nombre"] ?>?">Eliminar</button>
                                    <input type="text" hidden name="idmateria" value="<?=  $obj["idmateria"] ?>">
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
