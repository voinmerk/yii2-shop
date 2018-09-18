<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;

$js = <<< JS
$(document).on("beforeSubmit", "#form-signup", function () {
    var form = $(this);
    
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        success: function (response) {
            var getupdatedata = $(response).find('#filter_id_test');
            // $.pjax.reload('#note_update_id'); for pjax update
            // $('#yiiikap').html(getupdatedata);
            console.log(getupdatedata);
        },
        error: function () {
            console.log('internal server error');
        }
    });
    return false;
});

$(document).ready(function(){
    $('#signupform-country').change(function(){
        //$.ajax({
        //    type: 'post',
        //    url: '/common'
        //});
    });
});
JS;


$this->registerJs($js);
?>
<div class="container">
    <div class="site-signup">
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title"><i class="fa fa-user"></i> Регистрация</h2>
                    </div>

                    <div class="panel-body">
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                        <?= $form->field($model, 'first_name')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'last_name')->textInput() ?>

                        <?= $form->field($model, 'username')->textInput() ?>

                        <?= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'country')->dropDownList($countries, ['prompt' => 'Выберите страну...']); ?>

                        <?= $form->field($model, 'region')->dropDownList($regions, ['prompt' => 'Выберите регион...']); ?>

                        <?= $form->field($model, 'city')->dropDownList($cities, ['prompt' => 'Выберите город...']); ?>

                        <?php ActiveForm::end(); ?>
                    </div>

                    <div class="panel-footer clearfix">
                        <?= Html::a('У вас есть аккаунт?', ['auth/login'], ['class' => 'btn btn-link pull-left']) ?>.

                        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary pull-right', 'name' => 'signup-button', 'form' => 'form-signup']) ?>
                    </div>

                </div>
            </div>

            <div class="col-md-3"></div>
        </div>
    </div>
</div>