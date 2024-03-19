<?php
/** @var yii\web\View $this */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'User Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="theme/assets/img/favicon.png" rel="icon">
  <link href="theme/assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="theme/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="theme/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="theme/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="theme/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="theme/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="theme/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="theme/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="theme/assets/css/style.css" rel="stylesheet">

</head>
<body>

    <main>
        <div class="container" id="main">
            <div class="user-create">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Register Here!</h5>
            <div class="row g-3">
                <?php $form = ActiveForm::begin() ?>
                    <div class="col-12 mt-2">
                        <?= $form->field($user, 'name')->textInput() ?>
                    </div>
                    <div class="col-12 mt-2">
                        <?= $form->field($user, 'username')->textInput() ?>
                    </div>
                    <div class="col-12 mt-2">
                        <?= $form->field($user, 'email')->textInput() ?>
                    </div>
                    <div class="col-12 mt-2">
                        <?= $form->field($user, 'password')->textInput() ?>
                    </div>
                    <div class="col-12 mt-2">
                        <?= $form->field($user, 'confirm_password')->textInput() ?>
                    </div>
                    <div class="col-12 mt-2">
                        <?= $form->field($user, 'authKey')->textInput() ?>
                    </div>
                    <div class="col-12 mt-2">
                        <?= $form->field($user, 'role')->dropDownList([
                            ' ' => 'Select Role' ] + \yii\helpers\ArrayHelper::map($role, 'id', 'name')
                        ) ?>
                    </div>
                    <div class="col-12 mt-2">
                        <?= $form->field($user, 'image')->fileInput() ?>
                    </div>
                    <div class="text-center mt-3">
                        <?= Html::submitButton('Register', ['class' => 'btn btn-success']) ?>
                        AllReady Have an Account?<?= Html::a('Login', ['site/login']) ?>
                    </div>

                </div>
            </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="theme/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="theme/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="theme/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="theme/assets/vendor/echarts/echarts.min.js"></script>
  <script src="theme/assets/vendor/quill/quill.min.js"></script>
  <script src="theme/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="theme/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="theme/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="theme/assets/js/main.js"></script>

</body>