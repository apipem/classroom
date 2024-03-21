<?php

namespace app\models;

use Yii;

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
 *
 * @property Curso[] $cursos
 * @property Curso[] $cursos0
 */
class Usuario extends \yii\db\ActiveRecord
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
            [['cc'], 'integer'],
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
}
