<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\web\JsExpression;

/** @var View $this */
/** @var app\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .custom {
        border-radius: 40px;
    }
</style>
<div class="product-view border p-5 bg-white rounded">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-6">
            <?php $productImage = Yii::$app->request->baseUrl . '/images/' . $model->image; ?>
            <?= Html::img($productImage, ['alt' => 'Product Image', 'class' => 'img-thumbnail custom', 'height' => 1200, 'width' => 600]) ?>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h4><?= Html::encode($model->name) ?> </h4>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <h6><?= Html::encode($model->meta_title) ?> </h6>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <p>Price: $<?= Html::encode($model->price) ?> </p>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <?php if ($model->qty >= 10): ?>
                        <p>Stock: Available</p>
                    <?php else: ?>
                        <p>Stock: Only <?= Html::encode($model->qty) ?> Item Left </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-3">
                    <p>Quantity</p>
                    <?= Html::input('text', 'quantity', 1, ['class' => 'form-control', 'id' => 'quantity-input']) ?>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <p>More Details: <?= Html::encode($model->description) ?> </p>
                </div>
            </div>
            <button type="button" id="add-to-cart-button" class="btn btn-success">Add Cart</button>
            
           
        </div>
    </div>
</div>

<div class="mt-3"><?= Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
    $('#quantity-input').val(1);

    $('#add-to-cart-button').click(function (event) {
        event.preventDefault();

        var quantity = $('#quantity-input').val();
        // console.log('Quantity:', quantity);

        var productId = <?= $model->id; ?>;

        $.ajax({
            type: "POST",
            url: '<?= Yii::$app->urlManager->createUrl(['product/cart']) ?>',
            data: {
                id: productId,
                quantity: quantity
            },
            success: function (data) {
                console.log('Cart action success');
            },
            error: function () {
                console.log('Error in cart action');
            }
        });
    });
});

</script>



