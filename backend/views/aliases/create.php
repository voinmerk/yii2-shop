<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Aliases */

$this->title = 'Добавить ссылку';
$this->params['breadcrumbs'][] = ['label' => 'Ссылки', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить';
?>
<div class="aliases-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
