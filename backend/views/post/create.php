<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Post */

$this->title = 'Добавить запись';
$this->params['breadcrumbs'][] = ['label' => 'Записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить';
?>
<div class="post-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
