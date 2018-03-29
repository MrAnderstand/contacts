<?php

namespace frontend\controllers;

use Yii;
use common\models\Contact;
use common\models\ContactSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactController implements the CRUD actions for Contact model.
 */
class ContactController extends Controller
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
     * Lists all Contact models.
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->request->queryParams = array_merge(
            Yii::$app->session->get('ContactSearchParams', []),
            Yii::$app->request->queryParams
        );
        Yii::$app->session->set('ContactSearchParams', Yii::$app->request->queryParams);
        
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
// echo '<pre>';
// var_dump(Yii::$app->request->queryParams);
// echo '</pre>';
// die;
        $createModel = new Contact();
        
        $method = Yii::$app->request->isAjax ? 'renderAjax' : 'render';
        return $this->$method('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'createModel' => $createModel,
        ]);
    }

    /**
     * Creates a new Contact model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contact();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $queryParams = Yii::$app->request->queryParams;
            unset($queryParams['Contact[name]']);
            Yii::$app->request->queryParams = $queryParams;
            return $this->actionIndex();
        }
    }

    /**
     * Deletes an existing Contact model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id)
    {
        // sleep(7);
        $this->findModel($id)->delete();
        $queryParams = Yii::$app->request->queryParams;
        unset($queryParams['id']);
        unset($queryParams['_pjax']);
        Yii::$app->request->queryParams = $queryParams;
        return $this->actionIndex();
    }

    /**
     * Finds the Contact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
