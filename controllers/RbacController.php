<?php

namespace app\controllers;

use app\models\Fichas;
use app\models\FichasMigration;
use app\models\Programas;
use Yii;
use app\models\AuthItem;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RbacController implements the CRUD actions for AuthItem model.
 */
class RbacController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'lay-admin';

    public function behaviors()
    {
        return [
            //Descomentar cuando se halla creado y asignado el rol de administrador
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'create',
                            'update',
                            'delete',
                            'view',
                            'create-roles',
                            'admin-assignment',
                            'role-assignment'
                        ],
                        'allow' => false,
                        'roles' => ['@'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * @throws \Exception
     */
    //Esta funcion se encarga de crear los roles de la app y añadirlos en la tabla auth_item (custom-rbac-logic)
    public function actionCreateRoles(){
        $auth = Yii::$app->authManager;

        //Roles generales de la app
        $roles = [
            'administrador' => $auth->createRole('Administrador'),
            'profesor' => $auth->createRole('profesor'),
            'estudiante' => $auth->createRole('estudiante'),
        ];
        foreach ($roles as $role){
            $auth->add($role);
        }
    }

    /**
     * @throws \Exception
     */
   //Funcion para asignar permisos al administrador por defecto usuario con el id #1
    public function actionAdminAssignment(){
        $auth = Yii::$app->authManager;
        $admin = $auth->createRole('Administrador');
        $auth->assign($admin, 2);
    }

    /**
     * @param $role
     * @param $id
     * @throws \Exception
     */
    //Asignar roles a los usuarios
    public function actionRoleAssignment($role, $id){
        $auth = Yii::$app->authManager;
        if($role === 'Coordinador Academico'){
            $coordinadorAcademico = $auth->createRole($role);
            $auth->assign($coordinadorAcademico, $id);
        }
        if($role === 'profesor'){
            $profesor = $auth->createRole($role);
            $auth->assign($profesor, $id);
        }
        if($role === 'estudiante'){
            $estudiante = $auth->createRole($role);
            $auth->assign($estudiante, $id);
        }
    }


    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AuthItem::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
