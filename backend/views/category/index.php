<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список категорий';
$this->params['breadcrumbs'][] = 'Категории';
?>
<div class="category-index">
    <?php if(isset($error_warning)) { ?>
    <div class="alert alert-danger alert-dismissible">
        <p><i class="fa fa-exclamation-circle"></i> <?= $error_warning ?></p>

        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>

    <?php if(isset($success)) { ?>
    <div class="alert alert-success alert-dismissible">
        <p><i class="fa fa-check-circle"></i> <?= $success ?></p>

        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>

    <!-- <pre>
        <?= print_r($dataProvider) ?>

        // ------------------------------------------

        <?= print_r($searchModel) ?>
    </pre> -->

    <div class="box box-primary">
        <div class="box-header with-border">
            <h2 class="box-title"><i class="fa fa-list"></i> Список категорий</h2>

            <div class="pull-right">
                <a href="<?= Url::to(['/category/create']) ?>" data-toggle="tooltip" title="Добавить" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                <button type="submit" form="form-categories" formaction="<?= Url::to(['/category/copy']) ?>" data-toggle="tooltip" title="Копировать" class="btn btn-default" onclick="confirm('Вы действительно хотите копировать выбранные элементы?') ? $('#form-categories').submit() : false;"><i class="fa fa-copy"></i></button>
                <button type="button" form="form-categories" formaction="<?= Url::to(['/category/delete']) ?>" data-toggle="tooltip" title="Удалить" class="btn btn-danger" onclick="confirm('Вы действительно хотите удалить выбранные элементы') ? $('#form-categories').submit() : false;"><i class="fa fa-trash-o"></i></button>
            </div>
        </div>
        <div class="box-body table-responsive no-padding">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php /*echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout' => "{items}\n{summary}\n{pager}",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'title',
                    'description:ntext',
                    // 'image',
                    // 'meta_title',
                    // 'meta_keywords:ntext',
                    // 'meta_description:ntext',
                    // 'slug',
                    // 'sort_order',
                    'published',
                    // 'created_by',
                    // 'modified_by',
                    // 'created_at',
                    // 'updated_at',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);*/ ?>

            <div class="grid-view">
                <form id="form-categories" action="<?= Url::to(['/category/delete']) ?>" method="post" enctype="multipart/form-data">
                    <table id="category-table" class="table table-striped table-bordered" role="grid">
                        <thead>
                            <tr>
                                <th style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Публикация</th>
                                <th class="text-right">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($categories)) { ?>
                            <?php foreach($categories as $category) { ?>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="selected[]" value="<?= $category->id ?>" class="btn btn-default" />
                                </td>
                                <td><?= $category->title ?></td>
                                <td><?= $category->description ?></td>
                                <td>
                                    <?php if($category->published) { ?>
                                    <span class="label label-success">Опубликован</span>
                                    <?php } else { ?>
                                    <span class="label label-danger">Не опубликован</span>
                                    <?php } ?>
                                </td>
                                <td class="text-right">
                                    <a href="<?= Url::to(['/category/view', 'id' => $category->id]) ?>" class="btn btn-primary" data-toggle="tooltip" title="Просмотр"><i class="fa fa-eye"></i></a>
                                    <a href="<?= Url::to(['/category/update', 'id' => $category->id]) ?>" class="btn btn-warning" data-toggle="tooltip" title="Редактировать"><i class="fa fa-pencil"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php } else { ?>
                            <tr>
                                <td colspan="5" class="text-center"><h2>Данные отсутствуют</h2></td>
                            </tr>

                            <?= LinkPager::widget([
                                'pagination' => $pages,
                            ]); ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
