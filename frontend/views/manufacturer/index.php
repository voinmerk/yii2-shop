<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Производители';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-view">
	<div class="container">
		<div class="page-header">
			<h1><?= Html::encode($this->title) ?></h1>
		</div>

		<div class="row">
			<?php if(count($manufacturers)) { ?>
			<?php foreach($manufacturers as $manufacturer) { ?>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title"><?= Html::a($manufacturer['title'], Url::to(['manufacturer/view', 'id' => $manufacturer['slug']])); ?></h2>
					</div>

					<div class="panel-body">
						<?= Html::img('@web/' . $manufacturer['image'], ['style' => 'width: 100%;']) ?>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>