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
<h2 class="mt-5 mb-3">Notas</h2>
<?php if (Yii::$app->user->identity->rol == "profesor"){?>
    <div class="container">
        <form class="row g-3" action="<?= Yii::$app->getUrlManager()->createUrl('notas/filtro') ?>" method="get">
            <div class="col-md-6">
                <label for="proyecto" class="form-label">Proyecto</label>
                <select class="custom-select" id="proyecto" name="proyecto">
                    <option value="0" selected>Selecciona un proyecto</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="materias" class="form-label">Materia</label>
                <select  value="0" class="custom-select" id="materias" name="materia">
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
            <th>Corte1</th>
            <th>Corte2</th>
            <th>Corte3</th>
            <th>Final</th>

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
                <td><?=  $proyecto["corte1"] ?></td>
                <td><?=  $proyecto["corte2"] ?></td>
                <td><?=  $proyecto["corte3"] ?></td>
                <td><?=  $proyecto["nota"] ?></td>

                <?php if ($rol): ?>
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
