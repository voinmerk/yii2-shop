<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ManufacturerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Производители';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Create Manufacturer', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'title',
                'description:ntext',
                'image',
                'meta_title',
                // 'meta_keywords:ntext',
                // 'meta_description:ntext',
                // 'slug',
                // 'sort_order',
                // 'created_by',
                // 'modified_by',
                // 'created_at',
                // 'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
