<?php

namespace app\controllers;

use app\models\Notas;
use app\models\NotasSearch;
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

        return $this->redirect(['index']);
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
