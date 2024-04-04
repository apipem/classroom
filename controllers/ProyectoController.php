<?php

namespace app\controllers;

use app\models\Notas;
use app\models\Proyecto;
use app\models\ProyectoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;

/**
 * ProyectoController implements the CRUD actions for Proyecto model.
 */
class ProyectoController extends Controller
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
     * Lists all Proyecto models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProyectoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists Proyecto models.
     *
     * @return string
     */
    public function actionProyecto()
    {
        $perfil = "estudiante";

        if (Yii::$app->user->identity->rol == "profesor"){
            $perfil = "profesor";
        }
        $data = Proyecto::find()
            ->select('proyecto.*')
            ->innerJoin('notas', 'proyecto.idProyecto = notas.proyecto')
            ->innerJoin('curso', 'notas.idnotas = curso.notas')
            ->where(['curso.'.$perfil => Yii::$app->user->identity->id]);

        $data = $data->all();

        return $this->render('proyecto', [
            'data' => $data,
        ]);
    }

    public function actionGeneral()
    {
        $perfil = "estudiante";

        if (Yii::$app->user->identity->rol == "profesor"){
            $perfil = "profesor";
        }
        $data = Proyecto::find()
            ->select('proyecto.*')
            ->innerJoin('notas', 'proyecto.idProyecto = notas.proyecto')
            ->innerJoin('curso', 'notas.idnotas = curso.notas')
            ->where(['curso.'.$perfil => Yii::$app->user->identity->id]);

        $data = $data->all();

        return $this->render('general', [
            'data' => $data,
        ]);
    }

    /**
     * Lists Proyecto models.
     *
     * @return string
     */
    public function actionGrupos()
    {

        $query = new \yii\db\Query();

        if (Yii::$app->user->identity->rol == "profesor"){
            $data = $query
                ->select([
                    'proyecto.nombre AS nombre_proyecto',
                    'CONCAT(usuario.nombre, " ", usuario.apellido) AS nombre_estudiante'
                ])
                ->from('proyecto')
                ->innerJoin('notas', 'proyecto.idProyecto = notas.proyecto')
                ->innerJoin('curso', 'notas.idnotas = curso.notas')
                ->innerJoin('usuario', 'usuario.idUsuario = curso.estudiante')
                ->distinct()
                ->all();
        }else{
            $data = Proyecto::find()
                ->select('proyecto.idProyecto')
                ->innerJoin('notas', 'proyecto.idProyecto = notas.proyecto')
                ->innerJoin('curso', 'notas.idnotas = curso.notas')
                ->where(['curso.estudiante' => Yii::$app->user->identity->id])->all();

            if ($data){
                $data = $query
                    ->select([
                        'proyecto.nombre AS nombre_proyecto',
                        'CONCAT(usuario.nombre, " ", usuario.apellido) AS nombre_estudiante'
                    ])
                    ->from('proyecto')
                    ->innerJoin('notas', 'proyecto.idProyecto = notas.proyecto')
                    ->innerJoin('curso', 'notas.idnotas = curso.notas')
                    ->innerJoin('usuario', 'usuario.idUsuario = curso.estudiante')
                    ->innerJoin('materia', 'materia.idMateria = curso.materia')
                    ->where("notas.proyecto = ".$data[0]->idProyecto)
                    ->distinct()
                    ->all();
            }
        }

        return $this->render('grupos', [
            'data' => $data,
        ]);
    }

    /**
     * Displays a single Proyecto model.
     * @param int $idProyecto Id Proyecto
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idProyecto)
    {
        return $this->render('view', [
            'model' => $this->findModel($idProyecto),
        ]);
    }

    /**
     * Creates a new Proyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Proyecto();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $notas = new Notas();
                $notas->proyecto = $model->idProyecto;
                if ($notas->save()){
                    return $this->redirect(['view', 'idProyecto' => $model->idProyecto]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Proyecto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idProyecto Id Proyecto
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idProyecto)
    {
        $model = $this->findModel($idProyecto);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idProyecto' => $model->idProyecto]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Proyecto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idProyecto Id Proyecto
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idProyecto)
    {
        $this->findModel($idProyecto)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Proyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idProyecto Id Proyecto
     * @return Proyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idProyecto)
    {
        if (($model = Proyecto::findOne(['idProyecto' => $idProyecto])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
