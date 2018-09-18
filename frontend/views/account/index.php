<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Ваш аккаунт';
?>
<div class="container">
    <div class="account-index">
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-8">

            </div>

            <div class="col-md-4">
                <?= $this->render('widgets/menu'); ?>
            </div>
        </div>
    </div>
</div>