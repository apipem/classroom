<?php

namespace app\controllers;

use app\models\Contenido;
use app\models\ContenidoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $searchModel = new ContenidoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idcontenido' => $model->idcontenido]);
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
    public function actionUpdate($idcontenido)
    {
        $model = $this->findModel($idcontenido);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idcontenido' => $model->idcontenido]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
