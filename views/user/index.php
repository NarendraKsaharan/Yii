<?php

use App\models\User;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;
use yii\helpers\Url;

$this->title = 'User';
$this->params['breadcrumbs'][] = $this->title;

$user = Yii::$app->user->identity;
$dataProvider = null;

if ($user !== null) {
    if ($user->role === 'ADMIN' || $user->role === 'SUPERADMIN') {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
    } else {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->where(['id' => $user->id]),
        ]);
    }
}

?>

<div>
    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
</div>

<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'username',
        'email',
        'password',
        'role',
        // [
        //     'class' => 'yii\grid\ActionColumn',
        //     'visibleButtons' => [
        //         'view' => true,
        //         'update' => true,
        //         'delete' => function ($data) use ($user) {
        //             if (Yii::$app->user->id != $data->id && ($user->role === 'ADMIN' || $user->role === 'SUPERADMIN')) {
        //                 return Html::a('', 'delete', ['class' => 'delete']);
        //             }
        //         },
        //     ],
        // ],
        // [ 'class' => 'yii\grid\ActionColumn', 'urlCreator' => function ($action, User $model, $key, $index) { return Url::toRoute([$action, 'id' => $model->id]); }, 'template' => '{delete}', 
        //     'buttons' => [ 
        //         'myDelete' => function ($url, $model, $key) { return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [ 'title' => Yii::t('yii', 'Delete'), 'data' => [ 'confirm' => Yii::t('yii', 'Are You sure want to delete?'), 'method' => 'post', ], ]); }, 
        //     ], 
        // ],
        [
            'class' => 'yii\grid\ActionColumn',
            // 'template' => '{view} {update}', 
            'buttons' => [
                'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                        'class' => 'btn btn-danger delete-button',
                        'data-id' => $model->id,
                    ]);
                },
            ],
        ],
        
    ],
]);
?>

<?php Pjax::end(); ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-button').on('click', function(e) {
            var userId = $(this).data('id');
            // alert(userId);
            swal({
            title: "Are you sure?",
            text: "You want to delete this User..!",
            type: "warning",
            animateIn: "zoomInDown",
            animateOut : "zoomOutUp",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            },
            function(){
                $.ajax({
                    url   : '<?= Yii::$app->request->baseUrl. '/index.php?r=user/remove' ?>',
                    method: 'POST',
                    data  : {id: userId},
                    success: function(response) {
                        console.log('User deleted successfully');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting user:', error);
                    }
                });
            });
        });
    });
</script>

