<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Manufacturer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manufacturer-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'meta_keywords')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'meta_description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
