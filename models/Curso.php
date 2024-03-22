<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curso".
 *
 * @property int $idcurso
 * @property int $estudiante
 * @property int $materia
 * @property int $profesor
 * @property float|null $nota
 * @property int|null $notificacion
 * @property int $notas
 *
 * @property Usuario $estudiante0
 * @property Materia $materia0
 * @property Notas $notas0
 * @property Usuario $profesor0
 */
class Curso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'curso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estudiante', 'materia', 'profesor', 'notas'], 'required'],
            [['estudiante', 'materia', 'profesor', 'notificacion', 'notas'], 'integer'],
            [['nota'], 'number'],
            [['materia'], 'exist', 'skipOnError' => true, 'targetClass' => Materia::class, 'targetAttribute' => ['materia' => 'idmateria']],
            [['notas'], 'exist', 'skipOnError' => true, 'targetClass' => Notas::class, 'targetAttribute' => ['notas' => 'idnotas']],
            [['estudiante'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['estudiante' => 'idUsuario']],
            [['profesor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['profesor' => 'idUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcurso' => 'Idcurso',
            'estudiante' => 'Estudiante',
            'materia' => 'Materia',
            'profesor' => 'Profesor',
            'nota' => 'Nota',
            'notificacion' => 'Notificacion',
            'notas' => 'Notas',
        ];
    }

    /**
     * Gets query for [[Estudiante0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstudiante0()
    {
        return $this->hasOne(Usuario::class, ['idUsuario' => 'estudiante']);
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
     * Gets query for [[Notas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotas0()
    {
        return $this->hasOne(Notas::class, ['idnotas' => 'notas']);
    }

    /**
     * Gets query for [[Profesor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfesor0()
    {
        return $this->hasOne(Usuario::class, ['idUsuario' => 'profesor']);
    }
}
