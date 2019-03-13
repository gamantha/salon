<?php

namespace frontend\controllers;

use Yii;
use common\models\Transaction;
use common\models\Sales;
use common\models\Work;
use frontend\models\TransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\db\Query;
use yii\helpers\Json;
/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {

        $query = Transaction::find()->where(['not',['status' => 'deleted']]);

$provider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 500,
    ],
    'sort' => [
        'defaultOrder' => [
           // 'created_at' => SORT_DESC,
            //'title' => SORT_ASC, 
        ]
    ],
]);



        $searchModel = new TransactionSearch();
        $query = Yii::$app->request->queryParams;
        //$dataProvider = $searchModel->search($query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $provider,
        ]);
    }


    public function actionDailyindex()
    {
        
$date = strtotime("+1 day");
//echo date('m-d-y',$date);
        $query = Transaction::find()->andWhere(['not',['status' => 'deleted']])->andWhere(['>=', 'datetime', date('Y-m-d')])->andWhere(['<', 'datetime', date('Y-m-d', $date)]);
$provider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 10,
    ],
    'sort' => [
        'defaultOrder' => [
            //'created_at' => SORT_DESC,
            //'title' => SORT_ASC, 
        ]
    ],
]);
        return $this->render('dailyindex', [
            'dataProvider' => $provider,
        ]);

    }


    /**
     * Displays a single Transaction model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'transaction' => $id,
        ]);
    }

    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transaction();

        $model->datetime = date('Y-m-d h:i:s');
        $model->status = 'open';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
                           Yii::$app->session->setFlash('success', 'Transaction created');
            return $this->redirect(['dailyindex']);
        }

        return $this->render('create', [
            'model' => $model,

        ]);
    }

    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Transaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
  /*
        $sales = Sales::find()->andWhere(['transaction_id' => $id])->All();
        foreach ($sales as $sale) {
            Work::deleteAll(['sales_id' => $sale->id]);
        }
        Sales::deleteAll(['transaction_id' => $id]);

        $this->findModel($id)->delete();
*/
$model = $this->findModel($id);
$model->status = 'deleted';
$model->save();
        return $this->redirect(['dailyindex']);
    }

    /**
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    /** 
 * Your controller action to fetch the list
 */
public function actionCustomerList($q = null) {
    $query = new Query;
    
    $query->select('name')
        ->from('customer')
       // ->where('name LIKE "%' . $q .'%"')
        ->orderBy('name');
    $command = $query->createCommand();
    $data = $command->queryAll();
    $out = [];
    foreach ($data as $d) {
        $out[] = ['value' => $d['name']];
    }
    echo Json::encode($out);
}


}
