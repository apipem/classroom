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
            'coordinador' => $auth->createRole('Coordinador'),
            'directivo' => $auth->createRole('Directivo'),
            'gestorComisiones' => $auth->createRole('Gestor Comisiones'),
            'instructor' => $auth->createRole('Instructor'),
            'supervisor' => $auth->createRole('Supervisor'),
            'complementaria' => $auth->createRole('Complementaria'),
            'supervisorVirtual' => $auth->createRole('Supervisor Virtual'),
            'liderBienestar' => $auth->createRole('Lider Bienestar'),
            'auxiliarSubdireccion' => $auth->createRole('Auxiliar Subdireccion'),
            'gestionAmbiental' => $auth->createRole('Gestion Ambiental'),
            'gestorSeguridad' => $auth->createRole('Gestor Seguridad'),
            'auxiliarPVD' => $auth->createRole('Auxiliar PVD'),
            'aprendiz' => $auth->createRole('Aprendiz'),
            'liderContratoAprendizaje' => $auth->createRole('Lider Contrato Aprendizaje'),
            'liderOtrasAlternativas' => $auth->createRole('Lider Otras Alternativas'),
            'directorRegional' => $auth->createRole('Director Regional'),
            'recepcion' => $auth->createRole('Recepcion'),
            //'funcionariosArticulacion' => $auth->createRole('Funcionarios Articulacion'),
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
        $auth->assign($admin, 1);
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
        if($role === 'Directivo'){
            $directivo = $auth->createRole($role);
            $auth->assign($directivo, $id);
        }
        if($role === 'Gestor Comisiones'){
            $gestorComisiones = $auth->createRole($role);
            $auth->assign($gestorComisiones, $id);
        }
        if($role === 'Instructor'){
            $instructor = $auth->createRole($role);
            $auth->assign($instructor, $id);
        }
        if($role === 'Supervisor'){
            $supervisor = $auth->createRole($role);
            $auth->assign($supervisor, $id);
        }
        if($role === 'Complementaria'){
            $complementaria = $auth->createRole($role);
            $auth->assign($complementaria, $id);
        }
        if($role === 'Supervisor Virtual'){
            $supervisorVirtual = $auth->createRole($role);
            $auth->assign($supervisorVirtual, $id);
        }
        if($role === 'Lider Virtual'){
            $liderVirtual = $auth->createRole($role);
            $auth->assign($liderVirtual, $id);
        }
        if($role === 'Auxiliar Subdireccion'){
            $auxiliarSubdireccion = $auth->createRole($role);
            $auth->assign($auxiliarSubdireccion, $id);
        }
        if($role === 'Gestion Ambiental'){
            $gestionAmbiental = $auth->createRole($role);
            $auth->assign($gestionAmbiental, $id);
        }
        if($role === 'Gestor Seguridad'){
            $gestorSeguridad = $auth->createRole($role);
            $auth->assign($gestorSeguridad, $id);
        }
        if($role === 'Auxiliar PVD'){
            $auxiliarPVD = $auth->createRole($role);
            $auth->assign($auxiliarPVD, $id);
        }
        if($role === 'Aprendiz'){
            $aprendiz = $auth->createRole($role);
            $auth->assign($aprendiz, $id);
        }
        if($role === 'Lider Contrato Aprendizaje'){
            $liderContrato = $auth->createRole($role);
            $auth->assign($liderContrato, $id);
        }
        if($role === 'Lider Otras Alternativas'){
            $liderOtrasAlternativas = $auth->createRole($role);
            $auth->assign($liderOtrasAlternativas, $id);
        }
        if($role === 'Director Regional'){
            $directorRegional = $auth->createRole($role);
            $auth->assign($directorRegional, $id);
        }
        if($role === 'Recepcion'){
            $recepcion = $auth->createRole($role);
            $auth->assign($recepcion, $id);
        }
        /*if($role === 'Funcionarios Articulacion'){
            $funcionariosArticulacion = $auth->createRole($role);
            $auth->assign($funcionariosArticulacion, $id);
        }*/
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
