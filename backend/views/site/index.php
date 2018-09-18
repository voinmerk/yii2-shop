<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = Yii::$app->name . ' - Панель состояния';
?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-3">
            <?php echo \insolita\wgadminlte\LteSmallBox::widget([
                'type'=>\insolita\wgadminlte\LteConst::COLOR_LIGHT_BLUE,
                'title'=>'999',
                'text'=>'Новые заказы',
                'icon'=>'fa fa-shopping-cart',
                'footer'=>'Просмотреть <i class="fa fa-hand-o-right"></i>',
                'link'=>Url::to(['/site/index'])
            ]);?>
        </div>

        <div class="col-lg-3">
            <?php echo \insolita\wgadminlte\LteSmallBox::widget([
                'type'=>\insolita\wgadminlte\LteConst::COLOR_LIGHT_BLUE,
                'title'=>'999',
                'text'=>'Продажи',
                'icon'=>'fa fa-credit-card',
                'footer'=>'Просмотреть <i class="fa fa-hand-o-right"></i>',
                'link'=>Url::to(['/site/index'])
            ]);?>
        </div>

        <div class="col-lg-3">
            <?php echo \insolita\wgadminlte\LteSmallBox::widget([
                'type'=>\insolita\wgadminlte\LteConst::COLOR_LIGHT_BLUE,
                'title'=>'999',
                'text'=>'Клиенты',
                'icon'=>'fa fa-user',
                'footer'=>'Просмотреть <i class="fa fa-hand-o-right"></i>',
                'link'=>Url::to(['/site/index'])
            ]);?>
        </div>

        <div class="col-lg-3">
            <?php echo \insolita\wgadminlte\LteSmallBox::widget([
                'type'=>\insolita\wgadminlte\LteConst::COLOR_LIGHT_BLUE,
                'title'=>'999',
                'text'=>'Клиенты онлайн',
                'icon'=>'fa fa-users',
                'footer'=>'Просмотреть <i class="fa fa-hand-o-right"></i>',
                'link'=>Url::to(['/site/index'])
            ]);?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?php \insolita\wgadminlte\CollapseBox::begin([
                'type'=>\insolita\wgadminlte\LteConst::TYPE_INFO,
                'collapseRemember' => true,
                'collapseDefault' => false,
                'isSolid' => true,
                'boxTools' => '',
                'tooltip' => 'Последние невыполненные заказы',
                'title' => 'Новые заказы',
            ])?>

            <ul class="nav">
                <li><a href="#">Заказ на сумму 500 руб.</a></li>
                <li><a href="#">Заказ на сумму 500 руб.</a></li>
                <li><a href="#">Заказ на сумму 500 руб.</a></li>
                <li><a href="#">Заказ на сумму 500 руб.</a></li>
                <li><a href="#">Заказ на сумму 500 руб.</a></li>
                <li><a href="#">Заказ на сумму 500 руб.</a></li>
            </ul>

            <?php \insolita\wgadminlte\CollapseBox::end()?>
        </div>

        <div class="col-lg-6">
            <?php \insolita\wgadminlte\CollapseBox::begin([
                'type'=>\insolita\wgadminlte\LteConst::TYPE_INFO,
                'collapseRemember' => true,
                'collapseDefault' => false,
                'isSolid' => true,
                'boxTools' => '',
                'tooltip' => 'Недавно зарегистрированные пользователи',
                'title' => 'Новые пользователи',
            ])?>

            <ul class="nav">
                <li><a href="#">Jayden Wright</a></li>
                <li><a href="#">Jayden Wright</a></li>
                <li><a href="#">Jayden Wright</a></li>
                <li><a href="#">Jayden Wright</a></li>
                <li><a href="#">Jayden Wright</a></li>
                <li><a href="#">Jayden Wright</a></li>
            </ul>

            <?php \insolita\wgadminlte\CollapseBox::end()?>
        </div>
    </div>
</div>
