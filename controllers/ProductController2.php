<?php

namespace app\controllers;

use app\models\Product;
use app\models\Category;
use app\models\User;
use app\models\Cart;
use app\models\CartItem;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use Yii;
use app\models\ProductCategory;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'detail'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserSuperAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'detail'],
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
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    // public function actionCreate()
    // {
    //     $model    = new Product();
    //     $category = Category::find()->where(['status' => 1])->all();

    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post()) && $model->save()) {
    //             $model->image = UploadedFile::getInstance($model, 'image');
    //             if ($model->image) {
    //                 $path = 'C:\wamp64\www\basic\web\images\\' . $model->image->baseName. '.' . $model->image->extension;
    //                 $model->image->saveAs($path);
    //                 $model->image = $model->image->baseName. '.' . $model->image->extension;
    //             }
    //             $model->save();
    //             return $this->redirect(['product/index']);
    //         }
    //     } else {
    //         $model->loadDefaultValues();
    //     }

    //     return $this->render('create', [
    //         'model'    => $model,
    //         'category' => $category,
    //     ]);
    // }

    // echo "<pre>";
    // print_r($_POST);
    // exit;
  

    public function actionCreate()
    {
        $model = new Product();
        $category = Category::find()->where(['status' => 1])->all();

        if ($model->load(Yii::$app->request->post())) {
            // Save the product
            if ($model->save()) {
                $model->image = UploadedFile::getInstance($model, 'image');
                if ($model->image) {
                    $path = 'C:\wamp64\www\basic\web\images\\' . $model->image->baseName . '.' . $model->image->extension;
                    $model->image->saveAs($path);
                    $model->image = $model->image->baseName . '.' . $model->image->extension;
                }
                $model->save();

                // Associate product with selected categories
                $selectedCategoryIds = Yii::$app->request->post('Product')['category_id'];
                if (!empty($selectedCategoryIds)) {
                    foreach ($selectedCategoryIds as $category_id) {
                        $productCategory = new ProductCategory();
                        $productCategory->product_id = $model->id;
                        $productCategory->category_id = $category_id;
                        $productCategory->save();
                    }
                }

                return $this->redirect(['product/index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'category' => $category,
        ]);
    }



    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model    = $this->findModel($id);
        $category = Category::find()->where(['status' => 1])->all();
        $currentImage = $model->image; 

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

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
            $categoryIds = Yii::$app->request->post('product')['category_id'];
            ProductCategory::deleteAll(['product_id' => $model->id]);
            if (!empty($categoryIds)) {
                foreach ($categoryIds as $category) {
                    $productCategory = new ProductCategory();
                    $productCategory->product_id = $model->id;
                    $productCategory->category_id = $category;
                    $productCategory->save();
                }
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Product Updeted Suceessfully....');
                return $this->redirect(['product/index']);
            }
        }

        return $this->render('update', [
            'model'    => $model,
            'category' => $category,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $categories = ProductCategory::find()->where(['product_id' => $id])->all();
        foreach ($categories as $category) {
            $category->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDetail($id)
    {
        $model = Product::findOne($id);

        if (Yii::$app->request->isPost) {
        }
        return $this->render('detail', ['model' => $model]);
    }

    public function actionCart($id)
    {
        $session = Yii::$app->session;
        $session->open();
    
        // Check if 'quoteId' exists in the session
        if (!$session->has('quoteId')) {
            $quoteId = $session->get('quoteId');
            // Do something with $quoteId
        } else {
            $quoteId = Yii::$app->security->generateRandomString(20); // Generate a 20-character random string
            // echo "<pre>";
            // print_r($quoteId);
            // exit;
            $cart = new Cart();
            
            $cart->quote_id = $quoteId;
            // $quote->user_id = Yii::$app->user->id; 
            
            $cart->save();

            $cartId = $cart->id;
            $cartItem = new CartItem();
            $product = Product::findOne($id);
            $cartItem->cart_id = $cartId;
            $cartItem->product_id = $product->id;
            $cartItem->name = $product->name;
            $cartItem->price = $product->price;
            $cartItem->qty = 1;
            $cartItem->row_total = $cartItem->price * $cartItem->qty;
            $cartItem->save();

            // echo "<pre>";
            // print_r($cartItem);
            // exit;
            $cartItems = CartItem::find()->where(['cart_id' => $cartId])->sum('row_total');
            $cart->sub_total = $cartItems;
            $cart->total = $cart->sub_total;
            $cart->save();

            $session->set('quote_id', $quoteId);
        }
    
        return $this->redirect(Yii::$app->request->referrer);
        $session->close();
    
        // Rest of your action logic
    }
    


}
