<?php

$js = <<< JS

JS;

$this->registerJs($js);

?>
<div class="myModal">
    <div class="modal-product-cart">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Положить товар в корзину</h3>
        </div>

        <div class="panel-body">
          <?php if(isset($product)) { ?>
          <?= $this->render('_product', ['product' => $product]) ?>
          <?php } ?>
        </div>

        <div class="panel-footer">
          <div class="clearfix">

          </div>
        </div>
      </div>
    </div>
</div>