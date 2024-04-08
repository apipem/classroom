<?php

namespace app\controllers;

use app\models\Contenido;
use app\models\ContenidoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile; // Importar la clase UploadedFile
use Yii;
use yii\base\Model;

/**
 * ContenidoController implements the CRUD actions for Contenido model.
 */
class ContenidoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Contenido models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $proyectoId = "0";
        $materiaId = "0";

        $data = Contenido::find();
        if (isset($_GET["proyecto"]) ){
            $proyectoId = $_GET["proyecto"];
        }
        if (isset($_GET["materia"]) ){
            $materiaId = $_GET["materia"];
        }


        $data =  $data->innerJoin('materia', 'materia.idmateria = contenido.materia')
        ->innerJoin('curso', 'curso.materia = materia.idmateria')
        ;


        if ($proyectoId !== "0") {
            $data->andWhere(['proyecto' => $proyectoId]);
        }

        if ($materiaId !== "0") {
            $data->andWhere(['materia' => $materiaId]);
        }

        if (Yii::$app->user->identity->rol == "profesor"){
            $data = $data->andWhere("curso.profesor = ".\Yii::$app->user->identity->id);
        }else{
            $data = $data->andWhere("curso.estudiante = ".\Yii::$app->user->identity->id);
        }
        $data = $data->all();

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    /**
     * Displays a single Contenido model.
     * @param int $idcontenido Idcontenido
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idcontenido)
    {
        return $this->render('view', [
            'model' => $this->findModel($idcontenido),
        ]);
    }

    /**
     * Creates a new Contenido model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Contenido();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $files = UploadedFile::getInstances($model,'url');
                if ($files !== null) {
                    foreach ($files as $file) {
                        $filePath = 'recurso/' . $file->name ;
                        if ($file->saveAs($filePath)) {
                            $contenido = new Contenido();
                            $contenido->contenido = $filePath;
                            $contenido->descripcion = $model->descripcion;
                            $contenido->materia = $model->materia;
                            $contenido->proyecto = $model->proyecto;
                            $contenido->save();
                        }
                    }
                }
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Contenido model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idcontenido Idcontenido
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $contenido = Contenido::findOne(['idcontenido'=>$_POST["idcontenido"]]);

        $contenido->descripcion = $_POST["descripcion"];
        $contenido->materia = $_POST["materia"];
        $contenido->proyecto = $_POST["proyecto"];
        if ($contenido->save()){
            return "ok";
        }else{
            return "Error";
        }
    }

    /**
     * Deletes an existing Contenido model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idcontenido Idcontenido
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idcontenido)
    {
        $this->findModel($idcontenido)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contenido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idcontenido Idcontenido
     * @return Contenido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idcontenido)
    {
        if (($model = Contenido::findOne(['idcontenido' => $idcontenido])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
