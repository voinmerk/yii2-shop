<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\helpers\Url;

/**
 * Class OauthController
 *
 * @package frontend\controllers
 */
class OauthController extends Controller
{
    /**
     * Методы авторизации
     */
    const METHOD_VK = 'vk';
    const METHOD_INSTAGRAM = 'instagram';
    const METHOD_TWITTER = 'twitter';

    /*
     * Авторизация через VK
     *
     * @return \yii\web\Response
     */
    public function actionVk()
    {
        $oauth = new \VK\OAuth\VKOAuth();

        $client_id = Yii::$app->params['social_apps']['vk']['app_id'];
        $redirect_uri = Url::to('oauth/result', ['method' => self::METHOD_VK]);

        $display = \VK\OAuth\VKOAuthDisplay::PAGE;
        $scope = array(\VK\OAuth\Scopes\VKOAuthUserScope::WALL, \VK\OAuth\Scopes\VKOAuthUserScope::GROUPS);
        $state = '200';

        $browser_url = $oauth->getAuthorizeUrl(\VK\OAuth\VKOAuthResponseType::CODE, $client_id, $redirect_uri, $display, $scope, $state);

        return $this->redirect($browser_url);
    }

    /**
     * Авторизация через Instagram
     *
     * @return \yii\web\Response
     */
    public function actionInstagram()
    {
        $browser_url = Url::to('site/index'); // Заглушка

        return $this->redirect($browser_url);
    }

    /**
     * Авторизация через Twitter
     *
     * @return \yii\web\Response
     */
    public function  actionTwitter()
    {
        $browser_url = Url::to('site/index'); // Заглушка

        return $this->redirect($browser_url);
    }

    /*
     * Результат запроса авторизации от соц. сетей
     *
     * @params var $method - определяет соц. сеть через которую пользовотель провёл авторизацию
     *
     * @return mixed
     */
    public function actionResult($method = self::METHOD_VK, $code = null)
    {
        // Получение данных пользователя из соц. сети
        // Регистрация пользователя в случаее отсутствия аккаунта
        // Авторизация пользователя
        // Перенаправление на страницу пользователя (account/index)

        if($code != null) {
            // Авторизируем пользователя
            if($method == self::METHOD_VK) {
                // Запрос к ВК по полученному коду пользователя

            }
        } else {

        }

        // Yii::$app->end();

        return $this->redirect(Url::to('site/index')); // Заглушка
    }
}
