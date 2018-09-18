<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php if($products['count']) { ?>
    <div class="new-products">
        <div class="page-header">
            <h2>Новинки</h2>
        </div>

        <div class="row">
            <?php foreach($products['data'] as $product) { ?>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="catalog-item">
                        <span class="catalog-new">New</span>

                        <a href="#" class="catalog-zoom"><i class="fa fa-search"></i></a>

                        <?= Html::img('@web/' . $product['src'], ['class' => 'catalog-image']) ?>

                        <div class="catalog-tools btn-group" role="group" aria-label="">
                            <a href="<?= Url::to(['product/cart', 'id' => $product['id']]) ?>" class="btn btn-default ajax-popup" data-toggle="tooltip" data-placement="top" title="В корзину"><i class="fa fa-shopping-cart"></i> <span>Купить</span></a>
                            <a href="<?= Url::to(['product/like', 'id' => $product['id']]) ?>" class="btn btn-default ajax-like<?= $product['isLike'] ? ' is-like' : '' ?>" data-toggle="tooltip" data-placement="top" title="Оценка товара"><i class="fa fa-thumbs-up"></i> <span><?= $product['likes'] ?></span></a>
                        </div>

                        <div class="catalog-title">
                            <h4><a href="#"><?= $product['title'] ?></a></h4>
                        </div>

                        <div class="catalog-body">
                            <p><h4><?= $product['price'] ?> руб.</h4></p>
                            <p><?= $product['mini_description'] ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>