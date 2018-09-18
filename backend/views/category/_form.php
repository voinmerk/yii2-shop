<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form box box-primary">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'form-category']]); ?>
    <div class="box-body table-responsive">
        <?php // echo $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map($categories, 'id', 'title'), ['prompt' => '-- Без категории --', 'multiple' => true]) ?>
        <pre><?= print_r($categories) ?></pre>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'meta_keywords')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'meta_description')->textarea(['rows' => 6]) ?>

        <?php // echo $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'sort_order')->textInput() ?>

        <?= $form->field($model, 'published')->dropDownList(['0' => 'Не опубликовано', '1' => 'Опубликовано']) ?>

        <?php // echo $form->field($model, 'created_by')->textInput() ?>

        <?php // echo $form->field($model, 'modified_by')->textInput() ?>

        <?php // echo $form->field($model, 'created_at')->textInput() ?>

        <?php // echo $form->field($model, 'updated_at')->textInput() ?>

    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i></button>
    </div>
    <?php ActiveForm::end(); ?>
</div>
