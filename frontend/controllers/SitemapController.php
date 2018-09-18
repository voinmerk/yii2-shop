<?php
namespace frontend\controllers;

use yii\web\Controller;

// use frontend\models\Sitemap;

class SitemapController extends Controller
{
    public function actionIndex()
    {
        // $model = new Sitemap;

        return $this->redirect('site/index');
    }
}