<?php
namespace frontend\controllers;

// Yii
use Yii;
use yii\web\Controller;

// Models
use frontend\models\Cart;

// Models
// use frontend\models\Cart;

/**
 * Class CartController
 *
 * @package frontend\controllers
 */
class CartController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * Отобразит страницу корзины
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = [];

        $model = new Cart;

        if(!Yii::$app->user->isGuest) {
            $user = Yii::$app->user->identity->getId();
        } else {
            $user = Yii::$app->session->getId();
        }

        $products = $model->getProducts($user);

        $data['products'] = $products;

        return $this->render('index', $data);
    }

    /**
     * Добавление товара в корзину
     *
     * @param $id
     *
     * @return \yii\web\Response
     */
    public function actionCreate()
    {
        return $this->redirect('/cart'); // заглушка
    }

    /**
     * Удаление товара из корзины
     *
     * @param $id
     *
     * @return \yii\web\Response
     */
    public function actionDelete()
    {
        return $this->redirect('/cart'); // заглушка
    }
}