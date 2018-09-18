<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Banner */

$this->title = 'Добавить баннер';
$this->params['breadcrumbs'][] = ['label' => 'Баннеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить';
?>
<div class="banner-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
