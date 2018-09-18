<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'О нас';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="site-about">
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <div class="about-info">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error vero est autem quas dolor, quidem, sint veritatis sapiente sit eius dolores minus consequuntur, rerum dignissimos suscipit! Iste laudantium iusto quidem.</p>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur eveniet ad rem consectetur, illum aut alias. Minima rerum in provident labore, perferendis itaque nemo recusandae rem aliquam libero consectetur magni.</p>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam nostrum, eaque optio, perspiciatis veniam nobis animi esse similique, ab, commodi accusantium. Nostrum magni praesentium beatae, recusandae nulla mollitia molestias distinctio.</p>
        </div>
    </div>
</div>
