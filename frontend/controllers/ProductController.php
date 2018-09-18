<?php
namespace frontend\controllers;

use Yii;

// Base
use yii\base\InvalidArgumentException;

// Web
use yii\web\BadRequestHttpException;
use yii\web\Controller;

// Helpers
use yii\helpers\Url;
use yii\helpers\Json;

/**
 * Class ProductController
 *
 * @package frontend\controllers
 */
class ProductController extends Controller
{
    /**
     * Страница всех товаров по выбранной категории
     *
     * @return mixed
     */
    public function actionIndex()
    {
        //$request = Yii::$app->request;

        $data = [];

        $data['categories'] = \frontend\models\Category::getCategoryTree();

        $products = \frontend\models\Product::getProductsAll();

        if($products != false)
            $data['products'] = $products;
        
        return $this->render('index', $data);
    }

    /**
     * Страница товаров по выбранной категории
     */
    public function actionCategory($category)
    {
        $data = [];

        $data['categories'] = \frontend\models\Category::getCategoryTree();

        if($category) {
            $data['category'] = \frontend\models\Category::findOne(['slug' => $category]);
        }

        return $this->render('index', $data);
    }

    /**
     * Отображает выбранный товар по параметру $id|$alias
     *
     * @return mixed
     */
    public function actionView($product)
    {
        //$request = Yii::$app->request;

        // if(!$request->get('slug')) return $this->redirect('product/index');

        $data = [];

        $data['product'] = \frontend\models\Product::getProductById($product);

        return $this->render('view', $data);
    }

    /**
     * Вызывает AJAX диалог с параметрами для выбранного товара (link: addInCart)
     *
     * @return mixed
     */
    public function actionCart($id)
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $product = \frontend\models\Product::getProductById($id);

            return $this->renderAjax('ajax/product-cart', ['product' => $product]);
        }

        return $this->goBack();
    }

    /**
     * Экшин для оценки товара, ислючительно AJAX (post) запросы!
     * В ином случае редирект на магазин
     * Основной используемый формат - JSON
     *
     * @return string|\yii\web\Response
     */
    public function actionLike()
    {
        $request = Yii::$app->request;

        if(Yii::$app->user->isGuest) {
            return Json::encode([
                'error' => 'true',
                'message' => 'Только для авторизированных пользователей',
            ]);
        }

        if($request->isAjax && $request->post('id')) {
            return Json::encode([
                'error' => 'false',
                'message' => 'Спасибо вам за оценку! Товар так же добавлен в ваши закладки ;)',
                // 'likes' => $likes,
            ]);
        }

        return $this->redirect(['product/index']);
    }
}
