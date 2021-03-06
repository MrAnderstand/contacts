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
     * @param int $id   Id контакта
     * @return mixed
     * @throws NotFoundHttpException
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
     * Deletes an existing ContactPhones model.
     * @param integer $id       Id номера телефона
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
