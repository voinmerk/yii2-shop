<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

if(isset($category)) {
    $this->title = $category['meta_title'];

    $this->params['breadcrumbs'][] = [
        'label' => 'Каталог',
        'url' => ['/product/index'],
    ];

    $this->params['breadcrumbs'][] = $category['title'];
} else {
    $this->title = 'Все товары';
    $this->params['breadcrumbs'][] = 'Каталог';
}

$js = <<<JS
$(document).ready(function() {
	$('.ajax-popup').magnificPopup({
		type: 'ajax',
		alignTop: true,
		overflowY: 'scroll'
	});
	
	$('.catalog-zoom').magnificPopup({
		type: 'image',
		
		closeOnContentClick: true,
		closeBtnInside: false,

		fixedBgPos: true,
		fixedContentPos: true,
		
		midClick: true,
		removalDelay: 300,
		mainClass: 'mfp-with-zoom'
	});
	
	// Отправка POST запроса для оценки товара по клику пользователем
	$('.ajax-like').on('click', function(e) {
	    e.preventDefault();
	    
	    $.ajax({
	        type: 'POST',
	        url: $(this).attr('href'),
	        dataType: 'json',
	    });
	    
	    return false;
	});
});
JS;

$this->registerJs($js);
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
            <?php
                echo $this->render('_categories', [
                    'categories' => isset($categories) ? $categories : null,
                ]);
            ?>
        </div>

        <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
            <div class="catalog">
                <?php
                    echo $this->render('_category', [
                        'category' => isset($category) ? $category : null,
                    ]);

                    if(isset($products)) {
                        $row = 0;

                        foreach($products as $product) {
                            if(!$row) {
                                echo '<div class="row">';
                            }

                            $row++;

                            echo $this->render('_product', ['product' => $product]);

                            if($row == 3) {
                                echo '</div>';

                                $row = 0;
                            }
                        }
                    }
                ?>

                <!-- <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="catalog-item">
                            <span class="catalog-new">New</span>

                            <a href="<?= \Yii::getAlias('@web/uploads/product-1.jpg') ?>" class="catalog-zoom"><i class="fa fa-search"></i></a>

                            <?= Html::img('@web/uploads/product-1.jpg', ['class' => 'catalog-image']) ?>

                            <div class="catalog-tools btn-group" role="group" aria-label="">
                                <a href="<?= Url::to(['product/cart', 'id' => 1]) ?>" class="btn btn-default ajax-popup" data-toggle="tooltip" data-placement="top" title="В корзину"><i class="fa fa-shopping-cart"></i> <span>Купить</span></a>
                                <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Оценка товара"><i class="fa fa-thumbs-up"></i> <span>5</span></a>
                            </div>

                            <div class="catalog-title">
                                <h4><a href="#">Лонгслив</a></h4>
                            </div>

                            <div class="catalog-body">
                                <p><h4>2500 руб.</h4></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="catalog-item">
                            <a href="#" class="catalog-zoom"><i class="fa fa-search"></i></a>

                            <?= Html::img('@web/uploads/product-2.jpg', ['class' => 'catalog-image']) ?>

                            <div class="catalog-tools btn-group" role="group" aria-label="">
                                <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="В корзину"><i class="fa fa-shopping-cart"></i> <span>Купить</span></a>
                                <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Оценка товара"><i class="fa fa-thumbs-up"></i> <span>5</span></a>
                            </div>

                            <div class="catalog-title">
                                <h4><a href="#">Пин "В стране женщин"</a></h4>
                            </div>

                            <div class="catalog-body">
                                <p><h4>300 руб.</h4></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="catalog-item">
                            <span class="catalog-sale">Sale</span>

                            <a href="#" class="catalog-zoom"><i class="fa fa-search"></i></a>

                            <?= Html::img('@web/uploads/product-3.jpg', ['class' => 'catalog-image']) ?>

                            <div class="catalog-tools btn-group" role="group" aria-label="">
                                <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="В корзину"><i class="fa fa-shopping-cart"></i> <span>Купить</span></a>
                                <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Оценка товара"><i class="fa fa-thumbs-up"></i> <span>5</span></a>
                            </div>

                            <div class="catalog-title">
                                <h4><a href="#">Футболка Elf Circle</a></h4>
                            </div>

                            <div class="catalog-body">
                                <p><h4>1 800 руб.</h4></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="catalog-item">
                            <span class="catalog-new">New</span>

                            <a href="#" class="catalog-zoom"><i class="fa fa-search"></i></a>

                            <?= Html::img('@web/uploads/product-1.jpg', ['class' => 'catalog-image']) ?>

                            <div class="catalog-tools btn-group" role="group" aria-label="">
                                <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="В корзину"><i class="fa fa-shopping-cart"></i> <span>Купить</span></a>
                                <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Оценка товара"><i class="fa fa-thumbs-up"></i> <span>5</span></a>
                            </div>

                            <div class="catalog-title">
                                <h4><a href="#">Лонгслив</a></h4>
                            </div>

                            <div class="catalog-body">
                                <p><h4>2500 руб.</h4></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="catalog-item">
                            <a href="#" class="catalog-zoom"><i class="fa fa-search"></i></a>

                            <?= Html::img('@web/uploads/product-2.jpg', ['class' => 'catalog-image']) ?>

                            <div class="catalog-tools btn-group" role="group" aria-label="">
                                <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="В корзину"><i class="fa fa-shopping-cart"></i> <span>Купить</span></a>
                                <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Оценка товара"><i class="fa fa-thumbs-up"></i> <span>5</span></a>
                            </div>

                            <div class="catalog-title">
                                <h4><a href="#">Пин "В стране женщин"</a></h4>
                            </div>

                            <div class="catalog-body">
                                <p><h4>300 руб.</h4></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="catalog-item">
                            <span class="catalog-sale">Sale</span>

                            <a href="#" class="catalog-zoom"><i class="fa fa-search"></i></a>

                            <?= Html::img('@web/uploads/product-3.jpg', ['class' => 'catalog-image']) ?>

                            <div class="catalog-tools btn-group" role="group" aria-label="">
                                <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="В корзину"><i class="fa fa-shopping-cart"></i> <span>Купить</span></a>
                                <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Оценка товара"><i class="fa fa-thumbs-up"></i> <span>5</span></a>
                            </div>

                            <div class="catalog-title">
                                <h4><a href="#">Футболка Elf Circle</a></h4>
                            </div>

                            <div class="catalog-body">
                                <p><h4>1 800 руб.</h4></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>