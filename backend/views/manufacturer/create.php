<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Manufacturer */

$this->title = 'Добавить производителя';
$this->params['breadcrumbs'][] = ['label' => 'Производители', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить';
?>
<div class="manufacturer-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
