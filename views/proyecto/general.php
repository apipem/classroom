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

<div class="container">
    <h2 class="mt-5 mb-3">Grupos por proyecto</h2>
    <form class="row g-3">
        <div class="col-md-4">
            <label for="inputEmail4" class="form-label">Estudiante</label>
            <select class="custom-select">
                <option selected>Selecciona un estudiante</option>
                <option value="1">One</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="inputPassword4" class="form-label">Profesor</label>
            <select class="custom-select">
                <option selected>Selecciona un Profesor</option>
                <option value="1">One</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="inputPassword4" class="form-label">Materia</label>
            <select class="custom-select">
                <option selected>Selecciona una Materia</option>
                <option value="1">One</option>
            </select>
        </div>
        <div class="col-11">
        </div>
        <div class="col-1">
            <div class="text-right mb-3">
                <br>
                <button type="submit" class="btn btn-success">Enviar</button>
            </div>
        </div>
    </form>
</div>