<?php

namespace common\controllers;

// Bases
use yii\base\InvalidArgumentException;

// Webs
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * BaseController
 */
class BaseController extends Controller
{
	public $base_test;

	public function __construct()
	{
		$this->base_test = 'Hello world!';
	}
}