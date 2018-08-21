<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use app\models\Sale;
use app\models\SaleProduct;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SaleController implements the CRUD actions for Sale model.
 */
class SaleController extends Controller
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
     * Lists all Sale models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Sale::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sale model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$dataProvider = new ActiveDataProvider([
            'query' => SaleProduct::find()->with('sale')->where(['sale_id' => $id]),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
			'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Sale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sale();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
			try {
				$model->save();

				$count = count($model->products);
				$products = [new SaleProduct()];
				for ($i = 1; $i < $count; $i++) {
					$products[] = new SaleProduct();
				}
				Model::loadMultiple($products, $model->products, '');

				foreach ($products as $product) {
					$product->link('sale', $model);

					if ($product->product->quantity >= $product->quantity) {
						$product->product->quantity -= $product->quantity;
						$product->product->save();
					} else {
						$transaction->rollBack();
						return $this->render('create', [
							'model' => $model,
						]);
					}
                }
				$transaction->commit();
				return $this->redirect(['view', 'id' => $model->id]);
			} catch(\Exception $e) {
				$transaction->rollBack();
				throw $e;
			} catch(\Throwable $e) {
				$transaction->rollBack();
				throw $e;
			}
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Sale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sale::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
