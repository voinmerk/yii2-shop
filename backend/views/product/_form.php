<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->textInput() ?>

        <?= $form->field($model, 'meta_keywords')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'meta_description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'count')->textInput() ?>

        <?= $form->field($model, 'points')->textInput() ?>

        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'published')->textInput() ?>

        <?= $form->field($model, 'views')->textInput() ?>

        <?= $form->field($model, 'votes')->textInput() ?>

        <?= $form->field($model, 'sort_order')->textInput() ?>

        <?= $form->field($model, 'marker')->textInput() ?>

        <?= $form->field($model, 'product_status_id')->textInput() ?>

        <?= $form->field($model, 'created_by')->textInput() ?>

        <?= $form->field($model, 'modified_by')->textInput() ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
