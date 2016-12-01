<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property integer $uid
 * @property integer $idD
 * @property string $nombreP
 * @property double $saldo
 *
 * @property Departamento $idD0
 * @property Producto[] $productos
 * @property Registro[] $registros
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idD', 'nombreP'], 'required'],
            [['idD'], 'integer'],
            [['saldo'], 'number'],
            [['nombreP'], 'string', 'max' => 50],
            [['idD'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['idD' => 'idD']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'idD' => 'Id D',
            'nombreP' => 'Nombre P',
            'saldo' => 'Saldo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdD0()
    {
        return $this->hasOne(Departamento::className(), ['idD' => 'idD']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['uid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistros()
    {
        return $this->hasMany(Registro::className(), ['uid' => 'uid']);
    }
}
