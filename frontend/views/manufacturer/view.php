<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $manufacturer->meta_title;

$this->params['breadcrumbs'][] = [
	'label' => 'Производители',
    'url' => ['/manufacturer/index'],
];

$this->params['breadcrumbs'][] = $manufacturer->title;
?>
<div class="manufacturer-view">
	<div class="container">
		<div class="page-header">
			<h1><?= $manufacturer->title ?></h1>
		</div>

		<?= $manufacturer->description ?>
	</div>
</div>