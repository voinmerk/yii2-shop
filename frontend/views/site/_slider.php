<?php

use yii\bootstrap\Carousel;

if($carousel != null) {
    echo Carousel::widget([
        'items' => $carousel,
        'options' => [
            'class' => 'carousel slide',
            'data-interval' => '12000'
        ],
        'controls' => [
            '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
        ]
    ]);
}
