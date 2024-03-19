<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        $this->layout = false;
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    // public function actionLogout()
    // {
    //     Yii::$app->user->logout();

    //     return $this->goHome();
    // }

    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

    public function actionProfile()
    {
        $model = new User();
        return $this->render('profile',[
            'model' =>$model,
        ]);
    }

//     public function actionChangePassword()
//     {
//         $password = $_POST['password'];
//         $newpassword = $_POST['newpassword'];
//         $renewpassword = $_POST['renewpassword'];
//         $user = Yii::$app->user->identity;
//         $old_password = $user->password;
//         echo '<pre>'; print_r($old_password); echo '</pre>';exit;
//         // Assuming $user is an instance of your User model
// $old_password = $user->password; // This is the hashed password stored in the database

// // Check if the entered password is correct
// if (Yii::$app->security->validatePassword($enteredPassword, $old_password)) {
//     // Password is correct
// } else {
//     // Password is incorrect
// }
// // Assuming $user is an instance of your User model
// $old_password = $user->password; // This is the hashed password stored in the database

// // Check if the entered old password is correct
// if (Yii::$app->security->validatePassword($enteredOldPassword, $old_password)) {
//     // Old password is correct, proceed to change the password
//     $user->password = Yii::$app->security->generatePasswordHash($newPassword);
//     $user->save();

//     // Additional logic, such as redirecting the user or displaying a success message
// } else {
//     // Old password is incorrect, handle accordingly (e.g., show an error message)
// }

//     }
}
