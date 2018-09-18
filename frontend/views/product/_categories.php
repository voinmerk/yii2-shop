<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="<?= isset($parent) ? 'sub-categories' : 'categories' ?>">
    <?php if(isset($parent)) unset($parent); ?>
    <?php if($categories != null) { ?>
        <ul class="nav">
            <?php foreach($categories as $category) { ?>
            <?php if(isset($title)) { ?>
            <li class="title"><span><?= $title ?></span></li>
            <?php unset($title); ?>
            <?php } ?>
            <li class="dropdown">
                <a href="<?= Url::to(['product/category', 'category' => $category['slug']]) ?>"><?= $category['title'] ?><?= isset($category['items']) ? ' <span class="caret"></span>' : '' ?></a>

                <?php if(isset($category['items'])) { ?>
                <?= $this->render('_categories', ['categories' => $category['items'], 'parent' => true, 'title' => $category['title']]) ?>
                <?php } ?>
            </li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <ul class="nav">
            <li><h4>Нет категорий</h4></li>
        </ul>
    <?php } ?>
</div>