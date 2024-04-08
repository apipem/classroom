<?php

namespace app\controllers;

use app\models\Contenido;
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
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
                    'actions' => ['listestudiantes','listprofesores','listprofesoreselect','listmaterias','listproyectos','matricula','registronotas','materiaprofe'
                        ,'materiaid','listmateriasuser','listproyectosuser','deletecurso',
                        'updateproyectoestudiante','deletemateria','updatemateria','proyecto', 'deleteproyecto',
                        'deleterecurso'],
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

    public function actionProyecto()
    {
        $proyecto = new Proyecto();
        $proyecto->nombre =$_POST["nombre"] ;
        $proyecto->descripcion =$_POST["descripcion"] ;
        $proyecto->fechaIncio =$_POST["finicio"] ;
        $proyecto->fechaFin =$_POST["ffin"] ;

        if ($proyecto->save()) {
            return "ok";
        } else {
            return "Error";
        }

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

    public function actionListmateriasuser(){
        if (Yii::$app->user->identity->rol == "profesor"){
            return Json::encode(Materia::find()
                ->innerJoin('curso', 'curso.materia = materia.idmateria')
                ->where("curso.profesor = ".\Yii::$app->user->identity->id)
                ->all());
        }else{
            return Json::encode(Materia::find()
                ->innerJoin('curso', 'curso.materia = materia.idmateria')
                ->where("curso.estudiante = ".\Yii::$app->user->identity->id)
                ->all());
        }

    }

    public function actionListproyectosuser(){
        if (Yii::$app->user->identity->rol == "profesor"){
            return Json::encode(Proyecto::find()
                ->innerJoin('notas', 'notas.proyecto = proyecto.idproyecto')
                ->innerJoin('curso', 'curso.notas = notas.idnotas')
                ->where("curso.profesor = ".\Yii::$app->user->identity->id)
                ->all());
        }else{
            return Json::encode(Proyecto::find()
                ->innerJoin('notas', 'notas.proyecto = proyecto.idproyecto')
                ->innerJoin('curso', 'curso.notas = notas.idnotas')
                ->where("curso.estudiante = ".\Yii::$app->user->identity->id)
                ->all());
        }

    }

    public function actionRegistronotas(){

        $notas = Notas::findOne($_GET["idnotas"]);

        if ($notas !== null) {
            $notas->corte1 = $_GET["corte1"];
            $notas->corte2 = $_GET["corte2"];
            $notas->corte3 = $_GET["corte3"];

            if ($notas->save()) {
                $curso = Curso::findOne($_GET["idcurso"]);

                if ($curso !== null) {
                    $curso->nota = $_GET["final"];

                    if ($curso->save()) {
                        return "ok";
                    } else {
                        return "Error al guardar el curso";
                    }
                } else {
                    return "No se encontró el curso";
                }
            } else {
                return "Error al guardar las notas";
            }
        } else {
            return "No se encontraron las notas";
        }


    }

    public function actionMateriaid(){return Json::encode(Materia::find()->where("idmateria =".$_GET["id"])->all());}

    public function actionDeletecurso(){

        $idCurso = $_GET["idcurso"];

        $delete = Curso::deleteAll(['idcurso' => $idCurso]);

        if ($delete > 0) {
            return $this->redirect('../notas/notas');
        } else {
            return "No se pudo eliminar el curso";
        }
    }

    public function actionDeletemateria(){

        $id = $_GET["idmateria"];

        $delete = Materia::deleteAll(['idmateria' => $id]);

        if ($delete > 0) {
            return $this->redirect('../materia/listado');
        } else {
            return "No se pudo eliminar el curso";
        }
    }

    public function actionDeleteproyecto(){

        $id = $_GET["idproyecto"];

        $delete = Proyecto::deleteAll(['idproyecto' => $id]);

        if ($delete > 0) {
            return $this->redirect('../proyecto/index');
        } else {
            return "No se pudo eliminar el curso";
        }
    }

    public function actionDeleterecurso(){

        $id = $_GET["idcontenidodel"];

        $delete = Contenido::deleteAll(['idcontenido' => $id]);

        if ($delete > 0) {
            return $this->redirect('../contenido/index');
        } else {
            return "No se pudo eliminar el Recurso";
        }
    }

    public function actionUpdateproyectoestudiante(){

        $proyecto = $_POST["idproyecto"];
        $estudiante = $_POST["idestudiante"];

        $return = "ok";
        $cursos = Curso::find()->where(['estudiante' => $estudiante])->all();
        foreach ($cursos as $curso) {
            $curso = Curso::findOne($curso->idcurso);
            $nota = $curso->notas0;
            $nota->proyecto = $proyecto;

            if ($nota->save()){
                $return = "ok";
            }else{
                $return = "error";
            }

        }
        return $return;
    }

    public function actionUpdatemateria(){

    }
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
