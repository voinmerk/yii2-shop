<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="site-login">
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title"><i class="fa fa-sign-in"></i> Авторизация</h2>
                    </div>
                    
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <?php ActiveForm::end(); ?>
                    </div>

                    <div class="panel-footer clearfix">
                        <?= Html::a('Забыли пароль?', ['auth/request-password-reset'], ['class' => 'btn btn-link pull-left']) ?>.

                        <?= Html::submitButton('Вход', ['class' => 'btn btn-primary pull-right', 'name' => 'login-button', 'form' => 'login-form']) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-3"></div>
        </div>
    </div>
</div>
