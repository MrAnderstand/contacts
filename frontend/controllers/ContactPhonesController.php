<?php

namespace frontend\controllers;

use Yii;
use common\models\Contact;
use common\models\ContactPhones;
use common\models\ContactPhonesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactPhonesController implements the CRUD actions for ContactPhones model.
 */
class ContactPhonesController extends Controller
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
     * Lists all ContactPhones models.
     * @return mixed
     */
    public function actionIndex(int $id)
    {
        if (($contactModel = Contact::findOne($id)) === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
        $searchModel = new ContactPhonesSearch();
        $dataProvider = $searchModel->search($id, Yii::$app->request->queryParams);

        $createModel = new ContactPhones(['contact_id' => $id]);
        
        $method = Yii::$app->request->isAjax ? 'renderAjax' : 'render';
        return $this->$method('index', [
            'contactModel' => $contactModel,
            'dataProvider' => $dataProvider,
            'createModel' => $createModel,
        ]);
    }

    /**
     * Creates a new ContactPhones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContactPhones();
        $model->load(Yii::$app->request->post());
        $model->save();
        
        $queryParams = Yii::$app->request->queryParams;
        unset($queryParams['ContactPhones[phone_number]']);
        Yii::$app->request->queryParams = $queryParams;
        
        return $this->actionIndex($model->contact_id);
    }

    /**
     * Updates an existing ContactPhones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
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
     * Deletes an existing ContactPhones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id)
    {
        // sleep(7);
        $model = $this->findModel($id);
        $contactId = $model->contact_id;
        $model->delete();
        
        $queryParams = Yii::$app->request->queryParams;
        unset($queryParams['id']);
        unset($queryParams['_pjax']);
        Yii::$app->request->queryParams = $queryParams;
        return $this->actionIndex($contactId);
    }

    /**
     * Finds the ContactPhones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContactPhones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id)
    {
        if (($model = ContactPhones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
