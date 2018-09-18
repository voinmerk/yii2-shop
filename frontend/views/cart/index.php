<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Корзина';

?>
<div class="container">
    <div class="cart-index">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><i class="fa fa-shopping-cart"></i> Ваша корзина</h2>
            </div>

            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Фото</th>
                        <th>Наименование</th>
                        <th>Количество</th>
                        <th>Цена</th>
                        <th class="text-right">Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($products)) { ?>
                            <?php $number = 0; ?>
                            <?php foreach ($products as $product) { ?>
                                <?php $number++ ?>
                                <tr>
                                    <td><?= $number ?></td>
                                    <td><?= Html::img('@web/' . $product['image'], ['style' => 'width: 64px;']) ?></td>
                                    <td><a href="<?= Url::to('product/index', ['alias' => $product['url']]) ?>"><?= $product['title'] ?></a></td>
                                    <td><?= $product['quantity'] ?> шт.</td>
                                    <td><?= $product['price'] ?> руб.</td>
                                    <td class="text-right">
                                        <form id="form-cart-delete-<?= $product['id'] ?>" action="<?= Url::to('cart/delete', ['id' => $product['id']]) ?>" method="post">
                                            <input type="hidden" name="method" value="delete">

                                            <button type="submit" class="btn btn-danger"><i class="fa fa-close"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="6" class="text-center">Нет товаров. <a href="<?= Url::to('product/index') ?>">Добавить?</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="panel-footer clearfix">
                <a href="#" class="btn btn-success pull-right">Оформить заказ</a>
            </div>
        </div>
    </div>
</div>