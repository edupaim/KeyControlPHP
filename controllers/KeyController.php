<?php

namespace app\controllers;

use app\models\Customer;
use app\models\CustomerSearch;
use app\models\RoomType;
use Yii;
use app\models\Key;
use app\models\KeySearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Application;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KeyController implements the CRUD actions for Key model.
 */
class KeyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Key models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KeySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $typeList = \yii\helpers\ArrayHelper::map(RoomType::find()->all(),'id','name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'typeList' => $typeList
        ]);
    }

    /**
     * Displays a single Key model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Key model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Key();
        $typeList = \yii\helpers\ArrayHelper::map(RoomType::find()->all(),'id','name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'typeList' => $typeList
            ]);
        }
    }

    /**
     * Updates an existing Key model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $typeList = \yii\helpers\ArrayHelper::map(RoomType::find()->all(),'id','name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'typeList' => $typeList
            ]);
        }
    }

    /**
     * Deletes an existing Key model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Key model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Key the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Key::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionBorrow()
    {
        $customerList = ArrayHelper::map(Customer::find()->all(), 'id', 'allAttributes');
        $keyModel = new Key(['scenario' => 'borrow']);
        $keyList = ArrayHelper::map(Key::find()->all(), 'id', 'allAttributes');
        $keyListBorrowed = Key::find()->alreadyBorrowed()->all();
        $customerListDisabled = [];
        $keyListDisabled = [];

        foreach ($keyListBorrowed as $borrowed) {
            $customerListDisabled[$borrowed->customer_id] = ['disabled' => true];
            $keyListDisabled[$borrowed->id] = ['disabled' => true];
        }

        if (Yii::$app->request->post()) {
            $keyModel = $this->findModel(Yii::$app->request->post('Key')['id']);
            $keyModel->customer_id = Yii::$app->request->post('Key')['customer_id'];
            if ($keyModel->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('borrow', [
            'customerList' => $customerList,
            'keyModel' => $keyModel,
            'keyList' => $keyList,
            'customerListDisabled' => $customerListDisabled,
            'keyListDisabled' => $keyListDisabled,
        ]);

    }

    public function actionReturn()
    {
        $keyModel = new Key();
        $keyList = ArrayHelper::map(Key::find()->alreadyBorrowed()->all(), 'id', 'allAttributes');

        if (Yii::$app->request->post()) {
            $keyModel = $this->findModel(Yii::$app->request->post('Key')['id']);
            $keyModel->customer_id = null;
            if ($keyModel->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('return', [
            'keyModel' => $keyModel,
            'keyList' => $keyList
        ]);
    }


}
