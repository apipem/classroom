<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contenido".
 *
 * @property int $idcontenido
 * @property string $contenido
 * @property string $descripcion
 * @property int $materia
 * @property int $proyecto
 * @property int $user
 *
 * @property Materia $materia0
 * @property Proyecto $proyecto0
 * @property Usuario $user0
 */
class Contenido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contenido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contenido', 'descripcion', 'materia', 'proyecto', 'user'], 'required'],
            [['contenido', 'descripcion'], 'string'],
            [['materia', 'proyecto', 'user'], 'integer'],
            [['proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::class, 'targetAttribute' => ['proyecto' => 'idProyecto']],
            [['materia'], 'exist', 'skipOnError' => true, 'targetClass' => Materia::class, 'targetAttribute' => ['materia' => 'idmateria']],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['user' => 'idUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcontenido' => 'Idcontenido',
            'contenido' => 'Contenido',
            'descripcion' => 'Descripcion',
            'materia' => 'Materia',
            'proyecto' => 'Proyecto',
            'user' => 'User',
        ];
    }

    /**
     * Gets query for [[Materia0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMateria0()
    {
        return $this->hasOne(Materia::class, ['idmateria' => 'materia']);
    }

    /**
     * Gets query for [[Proyecto0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyecto0()
    {
        return $this->hasOne(Proyecto::class, ['idProyecto' => 'proyecto']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(Usuario::class, ['idUsuario' => 'user']);
    }
}
