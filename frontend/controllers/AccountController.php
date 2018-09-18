<?php
namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

use common\models\User;

/**
 * Class AccountController
 *
 * @package frontend\controllers
 */
class AccountController extends Controller
{
    private $user;

    /**
     * AccountController constructor.
     *
     * Получение персональных данных пользователя
     *
     * @param $id
     * @param Module $module
     * @param array $config
     */
    /*public function __construct($id, Module $module, array $config = [])
    {
        $this->user = User::find()->where(['id' => Yii::$app->user->identity->getId()]);

        parent::__construct($id, $module, $config);
    }*/

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'order', 'message', 'payment', 'setting'],
                'rules' => [
                    [
                        'actions' => ['index', 'order', 'message', 'payment', 'setting'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    /**
     * Профиль пользователя
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = [];

        return $this->render('index', $data);
    }

    /**
     * Список заказов
     *
     * @return string
     */
    public function actionOrder()
    {
        $data = [];

        return $this->render('order', $data);
    }

    /**
     * Управление тикетами (система обратной связи)
     *
     * @return string
     */
    public function actionMessage()
    {
        $request = Yii::$app->request;

        $data = [];

        switch($request->get('method'))
        {
            case 'view':
                $id = $request->get('id');

                if($id != null && is_numeric($id)) {

                } else {

                }
                break;

            default:

                break;
        }

        return $this->render('message', $data);
    }

    /**
     * Оплата
     *
     * @return string
     */
    public function actionPayment()
    {
        $data = [];

        return $this->render('payment', $data);
    }

    /**
     * Настройки аккаунта
     *
     * @return string
     */
    public function actionSetting()
    {
        $data = [];

        return $this->render('setting', $data);
    }
}