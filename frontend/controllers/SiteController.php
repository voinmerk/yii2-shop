<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use frontend\models\ContactForm;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use frontend\models\Banner;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Главная страница
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = [];

        $banners = Banner::getBanner('index_banner');

        if(count($banners['images'])) {
            foreach ($banners['images'] as $banner) {
                $data['carousel'][] = [
                    'content' => (!empty($banner['url'])) ? '<a href="'.$banner['url'].'">'.Html::img('@web/'.$banner['src'], ['title' => $banner['title'], 'alt' => $banner['alt']]).'</a>' : Html::img('@web/'.$banner['src'], ['title' => $banner['title'], 'alt' => $banner['alt']]),
                    
                    'caption' => $banner['caption'],
                    'options' => []
                ];
            }
        }

        /*echo '<pre>'.var_dump(\frontend\models\Category::getCategoryTree()).'</pre>';
        exit;*/

        /*

        $model = new \app\models\Product;

        $newProduct = $model->getProductByNew();
        $starProduct = $model->getProductByStar();
        $saleProduct = $model->getProductBySale();

        // Необходимо преобразовать полученные данные в модели, для удобного вывода и краткого запроса
        // Существует несколько таблиц которые необходимо связать селектами с оперетором AS
        foreach($newProduct as $product) {
            $data['products']['new']['data'][] = [
                'id' => $product['']
            ];
        }

        $data['products'] = [
            'new' => [
                'count' => count($newProduct),
                'data' => $newProduct
            ],
            'star' => [
                'count' => count($starProduct),
                'data' => $starProduct
            ],
            'sale' => [
                'count' => count($saleProduct),
                'data' => $saleProduct
            ],
        ];

        // StringHelper::truncate('Текст который нужно обрезать',150,'...');

        */

        $data['products'] = [
            'new' => [
                'count' => 0,
                'data' => []
            ],
            'star' => [
                'count' => 0,
                'data' => []
            ],
            'sale' => [
                'count' => 0,
                'data' => []
            ],
        ];

        return $this->render('index', $data);
    }

    /**
     * Displays aboutpage.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
}
