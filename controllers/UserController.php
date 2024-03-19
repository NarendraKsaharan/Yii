<?php

namespace app\controllers;

use app\models\Customer;
use app\models\User;
use app\models\Role;
use app\models\LoginForm;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;
use Yii;

use function PHPUnit\Framework\returnSelf;

class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['register'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'remove'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'remove'],
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

    public function actionIndex()
    {
        // $userId = Yii::$app->user->id;
        $user = User::find()->all();
       
        return $this->render('index', [
            'user' => $user,
        ]);
    }

    // public function actionRegister()
    // {
    //     $user = new User();
    //     $user->scenario = 'create';
    //     if ($this->request->isPost) {
    //         if ($user->load($this->request->post()) && $user->save()) {
    //             $user->password = md5($user->password);
    //             $user->save();
    //             Yii::$app->session->setFlash('success', $user->name. ' Register Successfully..');
    //             return $this->redirect(['site/login']);
    //         } else {
    //             Yii::$app->session->setFlash('error', 'Error Register User');
    //         }
    //     }
    //     return $this->render('register', ['user' => $user]);
    // }

    public function actionRegister()
    {
        $user = new User();
        $role = Role::find()->all();
        $user->scenario = 'create';
        if($this->request->isPost){
            if($user->load($this->request->post()) && ($user->save())){
                $user->password = md5($user->password);
                $user->confirm_password = $user->password;
                $user->role = ($user->role == 1 ) ? 'ADMIN' : 'USER';
                $user->save();
                $user->image = UploadedFile::getInstance($user, 'image');
                if ($user->image) {
                    $path = 'C:\wamp64\www\basic\web\images\\' . $user->image->baseName. '.' . $user->image->extension;
                    $user->image->saveAs($path);
                    $user->image = $user->image->baseName. '.' . $user->image->extension;
                }
                $user->save();
                Yii::$app->session->setFlash('success',$user->name. ' Registered Successfully...');
                return $this->redirect(['site/login']);
            }else {
                Yii::$app->session->setFlash('error', 'Error adding user');
            }
        }
        $this->layout = false;
        return $this->render('register', [
            'user' => $user,
            'role' => $role,
        ]);
    }

    public function actionCreate()
    {
        // echo "<pre>";
        // print_r($_POST);
        // exit;
        $user = new User();
        $role = Role::find()->all();
        $user->scenario = 'create';
        if($this->request->isPost){
            if($user->load($this->request->post()) && ($user->save())){
                $user->password = md5($user->password);
                $user->confirm_password = $user->password;
                $user->role = ($user->role == 1 ) ? 'ADMIN' : 'USER';
                $user->save();


                $user->image = UploadedFile::getInstance($user, 'image');
                if ($user->image) {
                    $path = 'C:\wamp64\www\basic\web\images\\' . $user->image->baseName. '.' . $user->image->extension;
                    $user->image->saveAs($path);
                    $user->image = $user->image->baseName. '.' . $user->image->extension;
                }
                $user->save();
                Yii::$app->session->setFlash('success',$user->username. ' Added Successfully...');
                return $this->redirect(['user/index']);
            }else {
                Yii::$app->session->setFlash('error', 'Error adding user');
            }
        }
        return $this->render('create', [
            'user' => $user,
            'role' => $role,
        ]);
    }

    // public function actionCreate()
    // {
    //     $user = new User();
    //     $user->scenario = 'create';

    //     if ($this->request->isPost) {
    //         $user->load($this->request->post());
    //         $user->profile_image = UploadedFile::getInstance($user, 'profile_image'); // Get the uploaded image

    //         if ($user->validate()) {
    //             if ($user->profile_image) {
    //                 $fileName = time() . '.' . $user->profile_image->extension;
    //                 $user->profile_image->saveAs('C:\wamp64\www\basic\web\images\\' . $fileName);
    //                 $user->profile_image = 'images/' . $fileName; // Set the file path

    //                 if ($user->save()) {
    //                     Yii::$app->session->setFlash('success', $user->username . ' Added Successfully...');
    //                     return $this->redirect(['user/index']);
    //                 } else {
    //                     Yii::$app->session->setFlash('error', 'Error saving user');
    //                 }
    //             } else {
    //                 Yii::$app->session->setFlash('error', 'Error uploading image');
    //             }
    //         }
    //     }

    //     return $this->render('create', ['user' => $user]);
    // }





    public function actionUpdate($id)
    {
        $user           = User::findOne($id);
        $userId         = Yii::$app->user->id;
        $loginUser      = User::findOne($userId);
        $role           = Role::find()->all();
        $newPassword    = '';
        $user->scenario = 'update';
        $currentImage   = $user->image; 

        if($this->request->isPost && $user->load($this->request->post())){
            if( ($userId == $id && $user->role == 'ADMIN') || ($userId != $id && $loginUser->role == 'ADMIN') || ($userId == $id && $user->role != 'ADMIN') ){
                if(empty($user->password)){
                    $user->password = $user->getOldAttribute('password');
                }else{
                    $newPassword = md5($user->password);
                    
                    $user->password = $newPassword;
                    $user->confirm_password = $user->password;
                    $user->role = ($user->role == 1 ) ? 'ADMIN' : 'USER';
                }
                $user->image = UploadedFile::getInstance($user, 'image');

                if ($user->image) {
                    if ($currentImage && file_exists(Yii::getAlias('@webroot/images/' . $currentImage))) {
                        unlink(Yii::getAlias('@webroot/images/' . $currentImage));
                    }

                    $fileName = 'image_' . time() . '.' . $user->image->extension;
                    $user->image->saveAs('images/' . $fileName);
                    $user->image = $fileName;
                } else {
                    $user->image = $currentImage;
                }
                if($user->save()){
                    Yii::$app->session->setFlash('success', $user->username. ' Updated Successfully...');
                    return $this->redirect(['user/index']);
                }else {
                    Yii::$app->session->setFlash('error', 'Error Updating user');
                }
            }else {
                    Yii::$app->session->setFlash('error', 'Error Updating user');
                }
            }
        return $this->render('update', [
            'user' => $user,
            'role' => $role,
        ]);
    }
    
    public function actionView($id)
    {
        $user = User::findOne($id);
        return $this->render('view', ['user' => $user]);
    }

    public function actionDelete($id)
    {
        // echo "<pre>";print_r('hiiii');exit;
        $user = User::findOne(['id' => $id]);
        $userId = Yii::$app->user->id;
       if (($userId == $id) && ($user->role == 'ADMIN')) {
           Yii::$app->session->setFlash('error', 'User Cant Delete....' );
           return $this->redirect(['user/index']);
        } else {
            $user = User::findOne($id)->delete();
            $customer = Customer::findOne(['user_id' => $id])->delete();
            Yii::$app->session->setFlash('success', 'User Deleted Successfully.....');
            return $this->redirect(['user/index']);
        }
    }
    
    public function actionRemove()
    {
        // echo "<pre>";print_r('hiiii');exit;
        $id = $_POST['id'];
        $user = User::findOne(['id' => $id]);
        $userId = Yii::$app->user->id;
        if (($userId == $id) && ($user->role == 'ADMIN')) {
            Yii::$app->session->setFlash('error', 'user cant delete this');
        } else {
            $user = User::findOne($id)->delete();
            $customer = Customer::find()->where(['user_id' => $id])->one();
            if ($customer) {
                $customer->delete();
            }
            Yii::$app->session->setFlash('success', 'User delete suceessfullly...');
            return $this->redirect(['user/index']);
        }
        
    }
    // public function actionLogin()
    // {
    //     return $this->render('login');
    // }

}
