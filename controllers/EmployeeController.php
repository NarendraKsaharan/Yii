<?php

namespace app\controllers;

use app\models\Employee;
use app\models\Country;
use app\models\State;
use app\models\City;
use app\models\User;
use app\models\EmployeeSearch;
// use GuzzleHttp\Psr7\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use Yii;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'state', 'city'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserSuperAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'state', 'city'],
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

    /**
     * Lists all Employee models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    public function actionCreate()
    {
        $model = new Employee();
        $country = Country::find()->where(['status' => 1])->all();
        $state   = State::find()->where(['status' => 1])->all();
        $city    = City::find()->where(['status' => 1])->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                if (is_array($model->hobbies) && !empty($model->hobbies)) {
                    $model->hobbies = implode(', ', $model->hobbies);
                } else {
                    $model->hobbies = null;
                }
                $model->image = UploadedFile::getInstance($model, 'image');
                if ($model->image) {
                    $path = 'C:\wamp64\www\basic\web\images\\' . $model->image->baseName. '.' . $model->image->extension;
                    $model->image->saveAs($path);
                    $model->image = $model->image->baseName. '.' . $model->image->extension;
                }
                $model->save();
                Yii::$app->session->setFlash('success', 'Employee Added Suceessfuly....');
                return $this->redirect(['employee/index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model'   => $model,
            'country' => $country,
            'state'   => $state,
            'city'    => $city,
        ]);
    }


    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $country = Country::find()->where(['status' => 1])->all();
        $state   = State::find()->where(['status' => 1])->all();
        $city    = City::find()->where(['status' => 1])->all();

        $currentImage = $model->image; 

        if ($model->load(Yii::$app->request->post())) {
            if (is_array($model->hobbies) && !empty($model->hobbies)) {
                $model->hobbies = implode(', ', $model->hobbies);
            } else {
                $model->hobbies = null;
            }
            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->image) {
                if ($currentImage && file_exists(Yii::getAlias('@webroot/images/' . $currentImage))) {
                    unlink(Yii::getAlias('@webroot/images/' . $currentImage));
                }

                $fileName = 'image_' . time() . '.' . $model->image->extension;
                $model->image->saveAs('images/' . $fileName);
                $model->image = $fileName;
            } else {
                $model->image = $currentImage;
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model'   => $model,
            'country' => $country,
            'state'   => $state,
            'city'    => $city,
        ]);
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = Employee::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionState()
    {
        
        if (!Yii::$app->request->isAjax) {
            throw new \yii\web\HttpException(405, Yii::t('app', 'model.error.not.allowed'));
        }
        $countryId = (Yii::$app->request->post('country_id'));
        $states = State::find()->where(['country_id' => $countryId])->all();
        
        $array = [];
        foreach($states as $key => $state)
        {
            $array[$key]['state_id']=$state->id;
            $array[$key]['state_name']=$state->department_name; 
        }
        echo json_encode($array);
    }

    public function actionCity()
    {
        if(Yii::$app->request->isAjax){
            $stateId = (Yii::$app->request->post('state_id'));
        }
        $cities = City::find()->where(['state_id' => $stateId])->all();
        
        $array = [];
        foreach($cities as $key => $city)
        {
            $array[$key]['city_id']=$city->id;
            $array[$key]['city_name']=$city->name; 
        }
        echo json_encode($array);
    }
}
