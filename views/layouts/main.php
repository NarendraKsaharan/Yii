<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
$this->title = 'Nuwave';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>                                                        
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>



  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php?r=site/index" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Nuwave</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <?php if (!Yii::$app->user->isGuest): ?>
                <?php
                $user = Yii::$app->user->identity;
                $profileImage = Yii::$app->request->baseUrl . '/images/' . $user->image;
                echo Html::img($profileImage, ['alt' => 'Profile', 'class' => 'rounded-circle']);
                ?>
                <span class="d-none d-md-block dropdown-toggle ps-2">
                    <?= $user->name ?>
                </span>
            <?php else: ?>
                Guest
            <?php endif; ?>
          </a><!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <?php if (!Yii::$app->user->isGuest): ?>
                  <h6><?= Yii::$app->user->identity->name ?></h6>
              <?php else: ?>
                  <h6>Guest</h6>
              <?php endif; ?>
              <span class="d-none d-md-block dropdown-toggle ps-2">
                  <?php if (!Yii::$app->user->isGuest): ?>
                      <?= Yii::$app->user->identity->role; ?>
                  <?php else: ?>
                      Guest    
                  <?php endif; ?>
              </span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
                <?php if (!Yii::$app->user->isGuest): ?>
                    <a class="dropdown-item d-flex align-items-center" href="index.php?r=site/profile">
                        <i class="bi bi-person"></i>
                        <span>My Profile</span>
                    </a>
                <?php else: ?>
                    <a class="dropdown-item d-flex align-items-center" href="<?= \yii\helpers\Url::to(['site/login']) ?>">
                        <i class="bi bi-person"></i>
                        <span>Login</span>
                    </a>
                <?php endif; ?>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <?php
                    echo Html::beginForm(['/site/logout'], 'post');
                    echo Html::submitButton(
                        '<i class="bi bi-person"></i><span>Sign Out</span>',
                        ['class' => 'nav-link btn btn-link logout']
                    );
                    echo Html::endForm();
                  ?>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
      <a class="nav-link" href="index.php?r=site/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
      </a>
  </li><!-- End Dashboard Nav -->

  <?php if (Yii::$app->user->isGuest) : ?>
      <!-- Display these options for guests (not logged in users) -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="index.php?r=site/index">
              <i class="bi bi-envelope"></i>
              <span>Home</span>
          </a>
      </li><!-- End Home Page Nav -->

      <li class="nav-item">
          <a class="nav-link collapsed" href="index.php?r=site/contact">
              <i class="bi bi-envelope"></i>
              <span>Contact Us</span>
          </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
          <a class="nav-link collapsed" href="index.php?r=site/about">
              <i class="bi bi-envelope"></i>
              <span>About Us</span>
          </a>
      </li>
  <?php endif; ?>

  <?php if (Yii::$app->user->isGuest) : ?>
      <!-- Display these options for guests (not logged in users) -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="index.php?r=site/login">
              <i class="bi bi-envelope"></i>
              <span>Login</span>
          </a>
      </li>

      <li class="nav-item">
          <a class="nav-link collapsed" href="index.php?r=user/register">
              <i class="bi bi-envelope"></i>
              <span>Register</span>
          </a>
      </li>
  <?php else : ?>
    <!-- Display these options for logged-in users -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?r=user/index">
            <i class="bi bi-envelope"></i>
            <span>Manage User</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?r=role/index">
            <i class="bi bi-envelope"></i>
            <span>Manage Role</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?r=country/index">
            <i class="bi bi-envelope"></i>
            <span>Manage Country</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?r=state/index">
            <i class="bi bi-envelope"></i>
            <span>Manage State</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?r=city/index">
            <i class="bi bi-envelope"></i>
            <span>Manage City</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?r=enquiry/index">
            <i class="bi bi-envelope"></i>
            <span>Manage Enquiry</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?r=employee/index">
            <i class="bi bi-envelope"></i>
            <span>Manage Employee</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?r=category/index">
            <i class="bi bi-envelope"></i>
            <span>Manage Category</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?r=product/index">
            <i class="bi bi-envelope"></i>
            <span>Manage Product</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?r=example/index">
            <i class="bi bi-envelope"></i>
            <span>Manage Image</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?r=customer/index">
            <i class="bi bi-envelope"></i>
            <span>Manage Customer</span>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?r=customer/join">
            <i class="bi bi-envelope"></i>
            <span>Joins</span>
        </a>
    </li>
    
    <li class="nav-item">
        <?php
        echo Html::beginForm(['/site/logout'], 'post');
        echo Html::submitButton(
            '<i class="bi bi-person"></i><span>Logout</span>',
            ['class' => 'nav-link btn btn-link logout']
        );
        echo Html::endForm();
        ?>
    </li>
  <?php endif; ?>

  </ul>


</aside><!-- End Sidebar-->

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright 2023 <strong><span>Nuwave</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://nuwave.com/">Narendra</a>
    </div>
  </footer><!-- End Footer -->




<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
