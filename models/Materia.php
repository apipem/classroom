<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materia".
 *
 * @property int $idmateria
 * @property string $nombre
 * @property string|null $codigo
 * @property string|null $vcorte1
 * @property string|null $vcorte2
 * @property string|null $vcorte3
 *
 * @property Contenido[] $contenidos
 * @property Curso[] $cursos
 */
class Materia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre', 'codigo', 'vcorte1', 'vcorte2', 'vcorte3'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idmateria' => 'Idmateria',
            'nombre' => 'Nombre',
            'codigo' => 'Codigo',
            'vcorte1' => 'Vcorte1',
            'vcorte2' => 'Vcorte2',
            'vcorte3' => 'Vcorte3',
        ];
    }

    /**
     * Gets query for [[Contenidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContenidos()
    {
        return $this->hasMany(Contenido::class, ['materia' => 'idmateria']);
    }

    /**
     * Gets query for [[Cursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Curso::class, ['materia' => 'idmateria']);
    }
}
