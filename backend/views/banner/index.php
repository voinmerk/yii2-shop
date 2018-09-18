<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Баннеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">
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

    <div class="box box-primary">
        <div class="box-header with-border">
            <h2 class="box-title"><i class="fa fa-list"></i> Список баннеров</h2>

            <div class="pull-right">
                <a href="<?= Url::to(['/banner/create']) ?>" data-toggle="tooltip" title="Добавить" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                <button type="submit" form="form-banners" formaction="<?= Url::to(['/banner/copy']) ?>" data-toggle="tooltip" title="Копировать" class="btn btn-default" onclick="confirm('Вы действительно хотите копировать выбранные элементы?') ? $('#form-banners').submit() : false;"><i class="fa fa-copy"></i></button>
                <button type="button" form="form-banners" formaction="<?= Url::to(['/banner/delete']) ?>" data-toggle="tooltip" title="Удалить" class="btn btn-danger" onclick="confirm('Вы действительно хотите удалить выбранные элементы?') ? $('#form-banners').submit() : false;"><i class="fa fa-trash-o"></i></button>
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

                    'id',
                    'name',
                    'widget',
                    'published',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);*/ ?>

            <div class="grid-view">
                <form id="form-banners" action="<?= Url::to(['/banner/delete']) ?>" method="post" enctype="multipart/form-data">
                    <table id="banner-table" class="table table-striped table-bordered" role="grid">
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
                            <?php if(count($banners)) { ?>
                            <?php foreach($banners as $banner) { ?>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="selected[]" value="<?= $banner->id ?>" class="btn btn-default" />
                                </td>
                                <td><?= $banner->title ?></td>
                                <td><?= $banner->description ?></td>
                                <td>
                                    <?php if($banner->published) { ?>
                                    <span class="label label-success">Опубликован</span>
                                    <?php } else { ?>
                                    <span class="label label-danger">Не опубликован</span>
                                    <?php } ?>
                                </td>
                                <td class="text-right">
                                    <a href="<?= Url::to(['/banner/view', 'id' => $banner->id]) ?>" class="btn btn-primary" data-toggle="tooltip" title="Просмотр"><i class="fa fa-eye"></i></a>
                                    <a href="<?= Url::to(['/banner/update', 'id' => $banner->id]) ?>" class="btn btn-warning" data-toggle="tooltip" title="Редактировать"><i class="fa fa-pencil"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <?php // echo LinkPager::widget(['pagination' => $pages]); ?>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php } else { ?>
                            <tr>
                                <td colspan="5" class="text-center"><h2>Данные отсутствуют</h2></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
