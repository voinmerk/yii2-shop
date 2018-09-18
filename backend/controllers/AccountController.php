<?php
namespace backend\controllers;

use yii\web\Controller;
use common\models\User;

/**
 * AccountController class
 */
class AccountController extends Controller
{
	public function actionIndex()
	{
		return $this->render('index', []);
	}
}