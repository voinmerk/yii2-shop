<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="site-contact">
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                <div class="contact-info">
                    <p>If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa et veniam accusamus suscipit optio corporis ullam dicta illum officiis harum molestias cum ipsum velit id tenetur nesciunt doloribus, pariatur quidem.</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo magnam aliquam alias sit atque provident consequuntur delectus amet debitis pariatur, laboriosam assumenda veniam nemo et aut, necessitatibus eaque in impedit?</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus id eligendi sed aspernatur similique quod quis nihil adipisci perferendis ad eum libero accusantium, reprehenderit, dolorem ex nulla recusandae architecto maiores!</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt vel, quae illo temporibus saepe velit iure ullam a consequatur itaque esse asperiores? Omnis minima alias, nam id, fuga fugiat similique!</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus non amet possimus officiis, ut praesentium nemo tempora soluta voluptatem labore nulla, eligendi totam maxime, voluptatum, dicta recusandae. Debitis, a, laboriosam.</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor nesciunt saepe nihil voluptates, accusantium sint, assumenda illo ipsa ab vel necessitatibus cum vero ducimus quam harum, a soluta. Maxime, blanditiis?</p>
                </div>
            </div>

            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Обратная связь</h2>
                    </div>

                    <div class="panel-body">
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'email') ?>

                            <?= $form->field($model, 'subject') ?>

                            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                            ]) ?>

                            <div class="form-group">
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
