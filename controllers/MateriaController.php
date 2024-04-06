<?php

namespace app\controllers;

use app\models\Materia;
use app\models\MateriaSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * MateriaController implements the CRUD actions for Materia model.
 */
class MateriaController extends Controller
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
     * Lists all Materia models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $perfil = "estudiante";

        if (Yii::$app->user->identity->rol == "profesor"){
            $perfil = "profesor";
        }

        $data = Materia::find()
        ->innerJoin('curso', 'materia.idmateria = curso.materia')
        ->where(['curso.'.$perfil => Yii::$app->user->identity->id])
            ->all();

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    public function actionListado()
    {

        $data = Materia::find()->all();

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    /**
     * Displays a single Materia model.
     * @param int $idmateria Idmateria
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idmateria)
    {
        return $this->render('view', [
            'model' => $this->findModel($idmateria),
        ]);
    }

    /**
     * Creates a new Materia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Materia();

        if ($this->request->isPost) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            if (isset($_POST["id"])){
                $materia = Materia::findOne(['idmateria' => $_POST["id"]]);
            }else{
                $materia = new Materia();
            }
            $materia->nombre = $_POST["nombre"] ;
            $materia->codigo = $_POST["codigo"] ;
            $materia->vcorte1 = $_POST["vcorte1"] ;
            $materia->vcorte2 = $_POST["vcorte2"] ;
            $materia->vcorte3 = $_POST["vcorte3"] ;
            if ($materia->save()){
                return 'ok';
            }else{
                return 'error';
            }

        } else {
            $materia = Materia::findOne(['idmateria' => $_GET["id"]]);

            if ($materia) {
                $materiaArray = $materia->attributes;
                return json_encode($materiaArray);
            } else {
                return json_encode(['error' => 'No se encontró la materia']);
            }
        }

    }

    /**
     * Updates an existing Materia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idmateria Idmateria
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idmateria)
    {
        $model = $this->findModel($idmateria);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idmateria' => $model->idmateria]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Materia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idmateria Idmateria
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idmateria)
    {
        $this->findModel($idmateria)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Materia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idmateria Idmateria
     * @return Materia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idmateria)
    {
        if (($model = Materia::findOne(['idmateria' => $idmateria])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
