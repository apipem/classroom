<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyecto".
 *
 * @property int $idProyecto
 * @property string $nombre
 * @property string $descripcion
 * @property string $fechaIncio
 * @property string $fechaFin
 *
 * @property Contenido[] $contenidos
 * @property Notas[] $notas
 */
class Proyecto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyecto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'fechaIncio', 'fechaFin'], 'required'],
            [['descripcion'], 'string'],
            [['fechaIncio', 'fechaFin'], 'safe'],
            [['nombre'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProyecto' => 'Id Proyecto',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'fechaIncio' => 'Fecha Incio',
            'fechaFin' => 'Fecha Fin',
        ];
    }

    /**
     * Gets query for [[Contenidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContenidos()
    {
        return $this->hasMany(Contenido::class, ['proyecto' => 'idProyecto']);
    }

    /**
     * Gets query for [[Notas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotas()
    {
        return $this->hasMany(Notas::class, ['proyecto' => 'idProyecto']);
    }
}
