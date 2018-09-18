<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

use frontend\models\Manufacturer;

class ManufacturerController extends Controller
{
    public function actionIndex()
    {
    	$manufacturers = Manufacturer::getListAll();

        return $this->render('index', ['manufacturers' => $manufacturers]);
    }

    public function actionView($id)
    {
    	$manufacturer = Manufacturer::getOne($id);

        return $this->render('view', ['manufacturer' => $manufacturer]);
    }
}
