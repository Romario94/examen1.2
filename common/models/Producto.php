<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property integer $idP
 * @property string $nombreP
 * @property double $precio
 * @property integer $uid
 * @property integer $cantidadC
 *
 * @property Persona $u
 * @property Registro[] $registros
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombreP', 'precio', 'uid', 'cantidadC'], 'required'],
            [['nombreP'], 'string'],
            [['precio'], 'number'],
            [['uid', 'cantidadC'], 'integer'],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['uid' => 'uid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idP' => 'Id P',
            'nombreP' => 'Nombre P',
            'precio' => 'Precio',
            'uid' => 'Uid',
            'cantidadC' => 'Cantidad C',
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
    public function getRegistros()
    {
        return $this->hasMany(Registro::className(), ['idP' => 'idP']);
    }
}
