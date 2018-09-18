<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = 'Добавить категорию';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить';
?>
<div class="category-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
