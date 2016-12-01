<?php

namespace frontend\controllers;

use Yii;
use common\models\Producto;
use common\models\Persona;
use \common\models\Registro;
use frontend\models\ProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['logout', 'update', 'view', 'delete', 'reporte'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                    [
                        'actions' => ['create', !'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Producto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Producto model.
     * @param integer $id
     * @return mixed
     */
    public function actionReporte() {
        $persona = Persona::find()->where(['nombreP' => Yii::$app->user->identity->id])->one();
        $dataProvider = new ActiveDataProvider([
            'query' => Registro::find()->where(['uid' => Yii::$app->user->identity->id])->select([new Expression('SUM(cantidad) as cantidad'), 'idP'])->groupBy('idP'),
        ]);

        return $this->render('reporte', [
                    'dataProvider' => $dataProvider,
                    'persona' => $persona
        ]);
    }

    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $dataProvider = new ActiveDataProvider([
            'query' => Producto::find(),
        ]);
        $modelRegistro = new Registro();
        $model = new Producto();
        if ($modelRegistro->load(Yii::$app->request->post())) {
            $modelRegistro->uid = Yii::$app->user->identity->id;
            if ($modelRegistro->save()) {
                $producto = Producto::find()->where(['idP' => $modelRegistro->idP])->one();
                $s = Persona::find()->where(['nombreP' => $modelRegistro->uid])->one();
                $saldo = $s->saldo + ($producto->precio * $modelRegistro->cantidad);

                Yii::$app->db->createCommand()->update('persona', ['saldo' => $saldo], 'nombreP =' . $modelRegistro->uid)->execute();

                return $this->redirect(['view', 'id' => $modelRegistro->idP]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'modelRegistro' => $modelRegistro,
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idP]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Producto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
