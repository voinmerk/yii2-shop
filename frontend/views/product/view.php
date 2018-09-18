<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $product['meta_title'];

$this->params['breadcrumbs'][] = [
    'label' => 'Каталог',
    'url' => ['/product/index'],
];

/*$this->params['breadcrumbs'][] = [
    'label' => $category['title'],
    'url' => ['product/category', 'category' => $category['slug']],
];*/

$this->params['breadcrumbs'][] = $product['title'];
?>
<div class="container">
	<div class="product-product">
		<div class="page-header">
            <h1><?= $product['title'] ?></h1>
        </div>
	</div>

	<div class="">
		<?= $product['description'] ?>
	</div>
</div>