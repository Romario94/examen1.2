<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "registro".
 *
 * @property integer $idR
 * @property integer $uid
 * @property integer $idP
 * @property integer $cantidad
 *
 * @property Persona $u
 * @property Producto $idP0
 */
class Registro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idP', 'cantidad'], 'required'],
            [['uid', 'idP', 'cantidad'], 'integer'],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['uid' => 'nombreP']],
            [['idP'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idP' => 'idP']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idR' => 'Id R',
            'uid' => 'Uid',
            'idP' => 'Id P',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(Persona::className(), ['uid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdP0()
    {
        return $this->hasOne(Producto::className(), ['idP' => 'idP']);
    }
    public function getComboProductos() {
        $model = Producto::find()->asArray()->all();

        return \yii\helpers\ArrayHelper::map($model, 'idP', 'nombreP');
    }

}
