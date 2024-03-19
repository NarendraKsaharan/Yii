<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

$this->title = $user->username;
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$userId = Yii::$app->user->id;
$users = User::findOne($userId);
?>

<div>
    <h1>
        <?= Html::encode($this->title); ?>
    </h1>
    <p>
        <?= Html::a('Update', ['update', 'id' => $user->id], ['class' => 'btn btn-primary']); ?>
        <?php  
            if(($users->role == 'ADMIN')){
                echo Html::a('Delete', ['delete', 'id' => $user->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]);
            }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $user,
        'attributes' => [
            'name',
            'username',
            'email',
            'authKey',
            'password',
        ]
    ]);
    ?>
</div>