<?php

namespace app\controllers;

use app\models\Curso;
use app\models\CursoSearch;
use app\models\Estudiante;
use app\models\Genero;
use app\models\Jornada;
use app\models\Materia;
use app\models\Matricula;
use app\models\Notas;
use app\models\Persona;
use app\models\Proyecto;
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
                    'actions' => ['persona'],
                    'allow' => true,
                    'roles' => ['?'],
                ],
                [
                    'actions' => ['listestudiantes','listprofesores','listprofesoreselect','listmaterias','listproyectos','matricula','registro','materiaprofe','materiaid'],
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
        $p->rol = $_GET["user"];
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

    public function actionListestudiantes(){return Json::encode(Usuario::find()->where("rol = 'estudiante'")->all());}

    public function actionListprofesores(){return Json::encode(Usuario::find()->where("rol = 'profesor'")->all());}

    public function actionListprofesoreselect(){
        $html = '<select class="custom-select" id="profesores">';
        $profesores = Usuario::find()->where("rol = 'profesor'")->all();
        foreach ($profesores as $profesor) {
            $html = $html ."<option value='".$profesor->idUsuario."'>".$profesor->nombre." ".$profesor->apellido."</option>";
        }

        $html = $html ."</select>";
        return $html;
    }



    public function actionListmaterias(){return Json::encode(Materia::find()->all());}

    public function actionListproyectos(){return Json::encode(Proyecto::find()->all());}

    public function actionRegistro(){
        $notas = new Notas();
        $notas->proyecto = $_GET["proyecto"];
        $notas->corte1 = 0;
        $notas->corte2 = 0;
        $notas->corte3 = 0;
        if ($notas->save()){
         $curso = new Curso();
         $curso->notas = $notas->idnotas;
         $curso->nota = 0;
         $curso->estudiante = $_GET["estudiante"];
         $curso->profesor = $_GET["profesor"];
         $curso->materia = $_GET["materia"];
            if ($curso->save()) {
                return "ok";
            } else {
                return "Error";
            }
        }else{
            return "Error";
        }

    }

    public function actionMateriaid(){return Json::encode(Materia::find()->where("idmateria =".$_GET["id"])->all());}

    public function actionMateriaprofe(){

        $return = "error";
        if(isset($_GET["matprof"])) {
            $matprof = $_GET["matprof"];

            foreach($matprof as $indice => $valor) {
                $notas = new Notas();
                $notas->proyecto = $_GET["proyecto"];
                $notas->corte1 = 0;
                $notas->corte2 = 0;
                $notas->corte3 = 0;

                if ($notas->save()){
                    $curso = new Curso();
                    $curso->notas = $notas->idnotas;
                    $curso->nota = 0;
                    $curso->estudiante = $_GET["estudiante"];
                    $curso->profesor = $valor[0];
                    $curso->materia = $valor[1];
                    if ($curso->save()) {
                        $return = "ok";
                    } else {
                        $return = "error";
                    }
                }else{
                    return "error";
                }
            }
        }

        return $return ;
    }


}
