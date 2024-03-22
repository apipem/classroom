<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notas".
 *
 * @property int $idnotas
 * @property float|null $corte 1
 * @property float|null $corte 2
 * @property float|null $corte 3
 * @property int $proyecto
 *
 * @property Curso[] $cursos
 * @property Proyecto $proyecto0
 */
class Notas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['corte 1', 'corte 2', 'corte 3'], 'number'],
            [['proyecto'], 'required'],
            [['proyecto'], 'integer'],
            [['proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::class, 'targetAttribute' => ['proyecto' => 'idProyecto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idnotas' => 'Idnotas',
            'corte 1' => 'Corte 1',
            'corte 2' => 'Corte 2',
            'corte 3' => 'Corte 3',
            'proyecto' => 'Proyecto',
        ];
    }

    /**
     * Gets query for [[Cursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Curso::class, ['notas' => 'idnotas']);
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
}
