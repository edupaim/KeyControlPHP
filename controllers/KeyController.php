<?php

namespace app\controllers;

use app\models\Customer;
use app\models\CustomerSearch;
use app\models\OperationHistory;
use app\models\RoomType;
use Faker\Provider\ka_GE\DateTime;
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
class KeyController extends AccessController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['@'],
                        'matchCallback' => function($rule) {
                            return $this->isAdmin;
                        }
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
        $typeList = \yii\helpers\ArrayHelper::map(RoomType::find()->all(), 'id', 'name');

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
        $typeList = \yii\helpers\ArrayHelper::map(RoomType::find()->all(), 'id', 'name');

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
        $typeList = \yii\helpers\ArrayHelper::map(RoomType::find()->all(), 'id', 'name');

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
        $customerModel = new Customer();
        $operationHistory = new OperationHistory();

        foreach ($keyListBorrowed as $borrowed) {
            $customerListDisabled[$borrowed->customer_id] = ['disabled' => true];
            $keyListDisabled[$borrowed->id] = ['disabled' => true];
        }

        if (Yii::$app->request->post()) {
            $customerRegistration = Yii::$app->request->post('Customer')['registration'];
            $key_id = Yii::$app->request->post('Key')['id'];
            $keyModel = $this->findModel($key_id);
            $customer_id = Yii::$app->request->post('Key')['customer_id'];
            $customer = Customer::find()->where(['id' => $customer_id])->one();
            if($customer->registration == $customerRegistration){
                $keyModel->customer_id = $customer_id;
                $this->loadHistory($operationHistory, $key_id, $customer_id, 1);
                $db = Yii::$app->db;
                $transaction = $db->beginTransaction();
                try {
                    if ($keyModel->save() && $operationHistory->save()) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            } else {
                $customerModel->addError('registration', 'A matricula não corresponde ao do beneficiário.');
            }
        }

        return $this->render('borrow', [
            'customerList' => $customerList,
            'keyModel' => $keyModel,
            'keyList' => $keyList,
            'customerListDisabled' => $customerListDisabled,
            'keyListDisabled' => $keyListDisabled,
            'customerModel' => $customerModel
        ]);

    }

    public function actionReturn()
    {
        $keyModel = new Key();
        $keyList = ArrayHelper::map(Key::find()->alreadyBorrowed()->all(), 'id', 'allAttributes');

        $operationHistory = new OperationHistory();

        if (Yii::$app->request->post()) {
            $keyModel = $this->findModel(Yii::$app->request->post('Key')['id']);
            $customer_id = $keyModel->customer_id;
            $keyModel->customer_id = null;
            $key_id = Yii::$app->request->post('Key')['id'];

            $this->loadHistory($operationHistory, $key_id, $customer_id, 2);
            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();
            try {
                if ($keyModel->save() && $operationHistory->save()) {
                    $transaction->commit();
                    return $this->redirect(['index']);
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
        return $this->render('return', [
            'keyModel' => $keyModel,
            'keyList' => $keyList
        ]);
    }

    /**
     * @param $operationHistory
     * @param $key_id
     * @param $customer_id
     * @param $operationType
     */
    public function loadHistory($operationHistory, $key_id, $customer_id, $operationType)
    {
        $operationHistory->user_id = Yii::$app->user->identity->id;
        $operationHistory->key_id = $key_id;
        $operationHistory->customer_id = $customer_id;
        $operationHistory->date = (new \DateTime('now', new \DateTimeZone('UTC')))->format('Y-m-d H:i:s');
        $operationHistory->type = $operationType;
    }


}
