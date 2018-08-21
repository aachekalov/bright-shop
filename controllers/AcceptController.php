<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use app\models\Accept;
use app\models\AcceptProduct;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AcceptController implements the CRUD actions for Accept model.
 */
class AcceptController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Accept models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Accept::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Accept model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$dataProvider = new ActiveDataProvider([
            'query' => AcceptProduct::find()->with('product')->where(['accept_id' => $id]),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
			'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Accept model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Accept();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			Yii::$app->db->transaction(function($db) use ($model) {
				$model->save();

				$count = count($model->products);
				$products = [new AcceptProduct()];
				for ($i = 1; $i < $count; $i++) {
					$products[] = new AcceptProduct();
				}
				Model::loadMultiple($products, $model->products, '');

				foreach ($products as $product) {
					$product->link('accept', $model);

					$product->product->quantity += $product->quantity;
					$product->product->save();
                }

				return $this->redirect(['view', 'id' => $model->id]);
			});
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Accept model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Accept the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Accept::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
