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
use app\models\Usuario;
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

    public function actionPersona()
    {
        $p = new Usuario();
        $p->cc = $_GET["cc"];
        $p->nombre = $_GET["name"];
        $p->apellido = $_GET["last"];
        $p->rol = "profesor";
        $p->correo = $_GET["email"];
        $p->contrasena = $_GET["password"];
        $p->estado = 0;

        if ($p->save()) {
            return "ok";
        } else {
            return "Error";
        }

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
