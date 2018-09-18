<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Manufacturer */

$this->title = 'Редактировать: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Производители', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="manufacturer-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
