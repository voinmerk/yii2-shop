<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php if(isset($product)) { ?>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
    <div class="catalog-item">
        <?= $product['marker'] ? '<span class="'.$product['marker_class'].'">'.$product['marker_text'].'</span>' : '' ?>

        <a href="<?= Yii::getAlias('@web/' . $product['image']) ?>" class="catalog-zoom img-zoom"><i class="fa fa-search"></i></a>

        <?= Html::img('@web/' . $product['image'], ['class' => 'catalog-image']) ?>

        <div class="catalog-tools btn-group" role="group" aria-label="">
            <a href="<?= $product['cart_url'] ?>" class="btn btn-default ajax-popup" data-toggle="tooltip" data-placement="top" title="В корзину"><i class="fa fa-shopping-cart"></i> <span>Купить</span></a>
            <a href="<?= Url::to(['product/like', 'id' => $product['id']]) ?>" class="btn btn-default ajax-like<?= $product['isLike'] ? ' is-like' : '' ?>" data-toggle="tooltip" data-placement="top" title="Оценка товара"><i class="fa fa-thumbs-up"></i> <span><?= $product['likes'] ?></span></a>
        </div>

        <div class="catalog-title">
            <h4><a href="<?= $product['url'] ?>"><?= $product['title'] ?></a></h4>
        </div>

        <div class="catalog-body">
            <p><h4><?= $product['price'] ?> руб.</h4></p>
            <p><?= $product['mini_description'] ?></p>
        </div>
    </div>
</div>
<?php } ?>
