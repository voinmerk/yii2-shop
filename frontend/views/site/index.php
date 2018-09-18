<?php

$this->title = Yii::$app->name;

$js = <<<JS
$(document).ready(function() {
	$('.ajax-popup').magnificPopup({
		type: 'ajax',
		alignTop: true,
		overflowY: 'scroll'
	});
	
	$('.catalog-zoom').magnificPopup({
		type: 'image',
		
		closeOnContentClick: true,
		closeBtnInside: false,

		fixedBgPos: true,
		fixedContentPos: true,
		
		midClick: true,
		removalDelay: 300,
		mainClass: 'mfp-with-zoom'
	});
	
	// Отправка POST запроса для оценки товара по клику пользователем
	$('.ajax-like').on('click', function(e) {
	    e.preventDefault();
	    
	    $.ajax({
	        type: 'POST',
	        url: $(this).attr('href'),
	        dataType: 'json',
	    });
	    
	    return false;
	});
});
JS;

$this->registerJs($js);
?>
<div class="container">
    <div class="catalog">
        <?= $this->render('_slider', ['carousel' => isset($carousel) ? $carousel : null]) ?>

        <?= $this->render('product/_new', ['products' => $products['new']]) ?>
        <?= $this->render('product/_star', ['products' => $products['star']]) ?>
        <?= $this->render('product/_sale', ['products' => $products['sale']]) ?>
    </div>
</div>