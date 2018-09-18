<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = 'Просмотр категории - ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
?>
<div class="category-view">
    <div class="box box-primary">
        <div class="box-header">
            <a href="<?= Url::to(['/category/update', 'id' => $model->id]) ?>" class="btn btn-primary btn-flat" data-toggle="tooltip" title="Редактировать"><i class="fa fa-pencil"></i></a>
            <a href="<?= Url::to(['/category/delete', 'selected' => $model->id]) ?>" class="btn btn-danger btn-flat" data-toggle="tooltip" title="Удалить" data-confirm="Вы действительно хотите уделить эту категорию?" data-method="post"><i class="fa fa-trash-o"></i></a>
        </div>
        <div class="box-body table-responsive no-padding">
            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'parent_id',
                    'title',
                    'description:ntext',
                    'image',
                    'meta_title',
                    'meta_keywords:ntext',
                    'meta_description:ntext',
                    'slug',
                    'sort_order',
                    'published',
                    'created_by',
                    'modified_by',
                    'created_at:datetime',
                    'updated_at:datetime',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Действие', 
                        'headerOptions' => ['class' => 'btn btn-default'],
                        'template' => '{view} {update} {delete}{link}',
                    ],
                ],
            ]) ?>

            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
