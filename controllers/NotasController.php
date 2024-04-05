<?php

namespace app\controllers;

use app\models\Curso;
use app\models\Notas;
use app\models\NotasSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotasController implements the CRUD actions for Notas model.
 */
class NotasController extends Controller
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
     * Lists all Notas models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NotasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionNotas()
    {

        $query = new \yii\db\Query();

        $misnotas = $query
            ->select([
                'proyecto.nombre AS nombre_proyecto',
                'materia.nombre AS nombre_materia',
                'curso.nota',
                'notas.corte1',
                'notas.corte2',
                'notas.corte3',
                'curso.idcurso AS idcurso',
                'materia.vcorte1 AS vcorte1',
                'materia.vcorte2 AS vcorte2',
                'materia.vcorte3 AS vcorte3',
                'CONCAT(usuario.nombre, " ", usuario.apellido) AS nombre_estudiante'
            ])
            ->from('notas')
            ->innerJoin('curso', 'curso.notas = notas.idnotas')
            ->innerJoin('proyecto', 'proyecto.idproyecto = notas.proyecto')
            ->innerJoin('materia', 'materia.idmateria = curso.materia')
            ->innerJoin('usuario', 'usuario.idusuario = curso.estudiante');
        if (\Yii::$app->user->identity->rol == "profesor"){
            $misnotas = $misnotas
                ->where("curso.profesor = ".\Yii::$app->user->identity->id);

        }else{
            $misnotas = $misnotas
                ->where("curso.estudiante = ".\Yii::$app->user->identity->id);
            }

        $misnotas = $misnotas->all();

        return $this->render('notas', [
            'notas' => $misnotas,
        ]);
    }

    public function actionCargueupdate()
    {
        $data = Curso::find()->where("idcurso = ".$_GET["data"])->all();

        $query = new \yii\db\Query();
        $query = $query
            ->select([
                'proyecto.nombre AS nombre_proyecto',
                'materia.nombre AS nombre_materia',
                'curso.nota',
                'notas.corte1',
                'notas.corte2',
                'notas.corte3',
                'curso.idcurso AS idcurso',
                'notas.idnotas AS idnotas',
                'materia.vcorte1 AS vcorte1',
                'materia.vcorte2 AS vcorte2',
                'materia.vcorte3 AS vcorte3',
                'CONCAT(usuario.nombre, " ", usuario.apellido) AS nombre_estudiante'
            ])
            ->from('notas')
            ->innerJoin('curso', 'curso.notas = notas.idnotas')
            ->innerJoin('proyecto', 'proyecto.idproyecto = notas.proyecto')
            ->innerJoin('materia', 'materia.idmateria = curso.materia')
            ->innerJoin('usuario', 'usuario.idusuario = curso.estudiante')
            ->where(['curso.profesor' => \Yii::$app->user->identity->id])
            ->andWhere(['curso.idcurso' => $data[0]["idcurso"]])
            ->andWhere(['curso.estudiante' => $data[0]["estudiante"]])
            ->andWhere(['curso.notas' => $data[0]["notas"]])
            ->all();

        return Json::encode($query);
    }

    public function actionFiltro()
    {

        $query = new \yii\db\Query();
        $query = $query
                ->select([
                    'proyecto.nombre AS nombre_proyecto',
                    'materia.nombre AS nombre_materia',
                    'curso.idcurso AS idcurso',
                    'materia.vcorte1 AS vcorte1',
                    'materia.vcorte2 AS vcorte2',
                    'materia.vcorte3 AS vcorte3',
                    'curso.nota',
                    'notas.corte1',
                    'notas.corte2',
                    'notas.corte3',
                    'CONCAT(usuario.nombre, " ", usuario.apellido) AS nombre_estudiante'
                ])
                ->from('notas')
                ->innerJoin('curso', 'curso.notas = notas.idnotas')
                ->innerJoin('proyecto', 'proyecto.idproyecto = notas.proyecto')
                ->innerJoin('materia', 'materia.idmateria = curso.materia')
                ->innerJoin('usuario', 'usuario.idusuario = curso.estudiante')
                ->where("curso.profesor = ".\Yii::$app->user->identity->id);
                $proyectoId = $_GET["proyecto"];
                $materiaId = $_GET["materia"];

                if ($proyectoId !== "0") {
                    $query->andWhere(['proyecto.idproyecto' => $proyectoId]);
                }

                if ($materiaId !== "0") {
                    $query->andWhere(['curso.materia' => $materiaId]);
                }
               $filtro = $query->all();

        return $this->render('notas', [
            'notas' => $filtro,
        ]);
    }
    /**
     * Displays a single Notas model.
     * @param int $idnotas Idnotas
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idnotas)
    {
        return $this->render('view', [
            'model' => $this->findModel($idnotas),
        ]);
    }

    /**
     * Creates a new Notas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Notas();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idnotas' => $model->idnotas]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Notas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idnotas Idnotas
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idnotas)
    {
        $model = $this->findModel($idnotas);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idnotas' => $model->idnotas]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Notas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idnotas Idnotas
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idnotas)
    {
        $this->findModel($idnotas)->delete();

        return $this->redirect(['idcurso']);
    }

    /**
     * Finds the Notas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idnotas Idnotas
     * @return Notas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idnotas)
    {
        if (($model = Notas::findOne(['idnotas' => $idnotas])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
