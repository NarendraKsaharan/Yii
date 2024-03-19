<?php

namespace app\controllers;

use app\models\Enquiry;
use app\models\User;
use app\models\EnquirySearch;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

class EnquiryController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserSuperAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUser(Yii::$app->user->identity->username);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new EnquirySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCreate()
    {
        // echo "<pre>";
        // print_r($_POST);
        // exit;
        $model = new Enquiry();
    
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
    
            Yii::$app->session->setFlash('success', 'Enquiry submitted successfully.');
            return $this->redirect(['enquiry/index']);
        }
        return $this->renderAjax('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = Enquiry::findOne($id);

        if (!$model) {
            throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();

            Yii::$app->session->setFlash('success', 'Enquiry updated successfully.');
            return $this->redirect(['user/index']);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionView($id)
    {
        $model = Enquiry::findOne($id); 
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Enquiry::findOne($id);
        $model->delete();
        return $this->redirect(['index']);
    }

}

?>