<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php if($category != null) { ?>
<div class="row">
    <div class="col-lg-12">
        <div class="category-info">
            <div class="page-header">
                <h1><?= $category['title'] ?></h1>
            </div>

            <?= Html::img($category['image'], ['class' => 'category-image']) ?>

            <div class="category-text">
                <?= $category['description'] ?>
            </div>
        </div>
    </div>
</div>
<?php } else { ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Каталог товаров</h1>
            </div>
        </div>
    </div>
<?php } ?>