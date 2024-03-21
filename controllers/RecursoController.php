<?php

namespace app\controllers;

use app\models\Curso;
use app\models\CursoSearch;
use app\models\Estudiante;
use app\models\Genero;
use app\models\Jornada;
use app\models\Matricula;
use app\models\Persona;
use app\models\Sede;
use app\models\TipoDocumento;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\Yii;

/**
 * CursoController implements the CRUD actions for Curso model.
 */
class RecursoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return ['access' => [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => ['cursos', 'jornadas', 'sedes','persona','genero','td'],
                    'allow' => true,
                    'roles' => ['?'],
                ],
                [
                    'actions' => ['estudiantes','matricula'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionSedes(){return Json::encode(Sede::find()->all());}

    public function actionCursos(){return Json::encode(Curso::find()->all());}

    public function actionJornadas(){return Json::encode(Jornada::find()->all());}

    public function actionGenero(){return Json::encode(Genero::find()->all());}

    public function actionTd(){return Json::encode(TipoDocumento::find()->all());}

    public function actionPersona()
    {
        $p = new Persona();
        $p->idPersona = "";
        $p->nombre = $_GET["n1"];
        $p->apellido = $_GET["a1"];
        $p->documento = $_GET["documento"];
        $p->celular = $_GET["ce"];
        $p->correo = $_GET["co"];
        $p->fechaNacimiento = $_GET["fn"];
        $p->direccion = $_GET["direccion"];
        $p->ciudad = $_GET["direccion"];
        $p->foto = "no tiene";
        $p->contrasena = $_GET["ce"];
        $p->genero = $_GET["genero"];
        $p->TipoDocumento = $_GET["td"];
        $p->save();

        $pa = new Persona();
        $pa->idPersona = "";
        $pa->nombre = $_GET["n2"];
        $pa->apellido = $_GET["a2"];
        $pa->documento = $_GET["documento"].$_GET["documento"];
        $pa->celular = $_GET["ce"];
        $pa->correo = $_GET["co"];
        $pa->fechaNacimiento = $_GET["fn"];
        $pa->direccion = $_GET["direccion"];
        $pa->ciudad = $_GET["direccion"];
        $pa->foto = "no tiene";
        $pa->contrasena = $pa->documento;
        $pa->genero = $_GET["genero"];
        $pa->TipoDocumento = $_GET["td"];
        $pa->save();

        $e = new Estudiante();
        $e->idestudiante = "";
        $e->estudiante = $p->idPersona;
        $e->acudiente = $pa->idPersona;
        $e->estado = 2;
        $e->save();

        $matricula = new Matricula();
        $matricula->estudiante = $e->idestudiante;
        $matricula->curso = $_GET["cur"];
        $matricula->complemento = "a";
        $matricula->sede = $_GET["se"];
        $matricula->jornada = $_GET["jor"];
        $matricula->save();

        return "ok";
    }

    public function actionEstudiantes(){
        $estudiantes = Matricula::find()->where('curso ='.$_GET["cur"])->all();
        $a = array();
        foreach ($estudiantes as $estudiante){
            $e = $estudiante->estudiante0->estudiante0;
            $e->foto = $estudiante->estudiante0->acudiente0->nombre." ".$estudiante->estudiante0->acudiente0->apellido;
            $a[] = $e ;
        }
        return Json::encode($a);
    }

    public function actionMatricula(){
        $s = Estudiante::findOne($_GET["cur"]);
        $s->estado = 1;
        $s->save();
        return "200";
    }

}
