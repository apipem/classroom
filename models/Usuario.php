<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuario".
 *
 * @property int $idUsuario
 * @property int $cc
 * @property string $nombre
 * @property string $apellido
 * @property string $correo
 * @property string $contrasena
 * @property string $rol
 * @property int $estado
 *
 * @property Curso[] $cursos
 * @property Curso[] $cursos0
 */
class Usuario extends \yii\db\ActiveRecord implements IdentityInterface

{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cc', 'nombre', 'apellido', 'correo', 'contrasena', 'rol'], 'required'],
            [['cc', 'estado'], 'integer'],
            [['correo', 'contrasena', 'rol'], 'string'],
            [['nombre', 'apellido'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUsuario' => 'Id Usuario',
            'cc' => 'Cc',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'correo' => 'Correo',
            'contrasena' => 'Contrasena',
            'rol' => 'Rol',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Cursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Curso::class, ['estudiante' => 'idUsuario']);
    }

    /**
     * Gets query for [[Cursos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos0()
    {
        return $this->hasMany(Curso::class, ['profesor' => 'idUsuario']);
    }


    //////////////////////Metodos para determinar si la persona es un funcionario o un aprendiz///////////////////
    public static function isFuncionario($id){

        if(self::findOne(['idUsuario' => $id])){
            return true;
        }
        return false;
    }

    public static function isEstudiante($id){
        if(self::findOne(['idUsuario' => $id])){
            return true;
        }
        return false;
    }

    public static function isAdministrador(){
        if(self::findOne(['idUsuario' => 2])){
            return true;
        }
        return false;
    }

    /////////////////////Encriptar password//////////////////
    public function beforeSave($insert)
    {
        try {
            $this->contrasena = Yii::$app->security->generatePasswordHash($this->contrasena);
        } catch (Exception $e) {
            echo $e;
        }

        return parent::beforeSave($insert);
    }

    /////////////////////////////////LOGiNNNNNNN////////////////////////////////

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return self::findOne(['idUsuario' => $id]);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //throw new NotSupportedException();
    }

    public static function findByUsername($username){

        return self::findOne(['cc' => $username]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->idUsuario;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     * @throws NotSupportedException
     */
    public function getAuthKey()
    {
        return $this->contrasena;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     * @throws NotSupportedException
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    /**
     * @param $password
     * @return bool
     */
    public function validatePassword($password){
        try{
            if(Yii::$app->security->validatePassword($password, $this->contrasena)){
                return true;
            }
        }catch(InvalidArgumentException $ex){
            return false;
        }
        //####GENERAR CONTRASENA A USUARIO NUEVO
        //$this->contrasena = 12345;
        //$this->save(false))
        //return true;
    }

    /** @param $displayField
     * @throws \yii\base\InvalidConfigException
     */
    public function dfIsFK($displayField){
        $fkKeys = self::getTableSchema()->foreignKeys;
        foreach($fkKeys as $key){
            if($key[0] === $displayField){
                $props = self::attributes();
                foreach($props as $prop){
                    if(strpos($prop,$displayField) !== false){
                        return $prop.'0';
                    }
                }
            }
        }
        return null;
    }


    /**
     * @inheritdoc
     */
    public function getIdModel(){
        return 'idUsuario';
    }

    /**
     * @inheritdoc
     */
    public function getDisplayField()
    {
        return 'nombre';
    }

    /**
     * @inheritdoc
     * @throws Exception
     */
    public function generatePasswordResetToken(){
        $this->password_reset_token = Yii::$app->security->generateRandomString().'_'.time();
    }

    /**
     * @inheritdoc
     */
    public function resetPasswordResetToken(){
        $this->password_reset_token = null;
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static null
     */
    public static function findByPasswordResetToken($token) {
        if (! static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'estado' => 'Activo'
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)){
            return false;
        }
        $expire = Yii::$app->params['passwordResetTokenExpire'];
        $parts = explode( '_', $token );
        $timestamp = (int)end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
