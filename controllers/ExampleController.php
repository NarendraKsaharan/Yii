<?php

namespace app\controllers;

use app\models\Example;
use app\models\User;
use app\models\ExampleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;
use yii\filters\AccessControl;

/**
 * ExampleController implements the CRUD actions for Example model.
 */
class ExampleController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserSuperAdmin(Yii::$app->user->identity->username);
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
     * Lists all Example models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ExampleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Example model.
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
     * Creates a new Example model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    
// ...

    // public function actionCreate()
    // {
    //     $model = new Example();

    //     if (Yii::$app->request->isPost) {
    //         $model->image = UploadedFile::getInstances($model, 'image');

    //         if ($model->validate()) {
    //             $imagePaths = [];

    //             // Process and save the uploaded files
    //             foreach ($model->image as $file) {
    //                 $filePath = 'images/' . $file->baseName . '.' . $file->extension;
    //                 $file->saveAs($filePath);
    //                 $imagePaths[] = $filePath;
    //             }

    //             // Convert the array of image paths to a string (e.g., "image1.jpg,image2.jpg")
    //             $model->image = implode(',', $imagePaths);

    //             // Save the model to the database
    //             if ($model->save()) {
    //                 // Model saved successfully
    //                 return $this->redirect(['view', 'id' => $model->id]);
    //             }
    //         }
    //     }

    //     return $this->render('create', ['model' => $model]);
    // }

    public function actionCreate()
{
    $model = new Example();

    if (Yii::$app->request->isPost) {
        $model->image = UploadedFile::getInstances($model, 'image');

        if ($model->validate()) {
            $imagePaths = [];

            foreach ($model->image as $file) {
                // Generate a unique filename based on a timestamp
                $fileName = Yii::$app->security->generateRandomString(10) . time() . '.' . $file->extension;
                $filePath = 'images/' . $fileName;

                // Save the file with the unique name
                $file->saveAs($filePath);

                $imagePaths[] = $filePath;
            }

            // Convert the array of image paths to a string
            $model->image = implode(',', $imagePaths);

            if ($model->save()) {
                // Model saved successfully
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    }

    return $this->render('create', ['model' => $model]);
}



    /**
     * Updates an existing Example model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Example model.
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
     * Finds the Example model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Example the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Example::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
