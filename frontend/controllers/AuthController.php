<?php
namespace frontend\controllers;

use Yii;

// Bases
use yii\base\InvalidArgumentException;

// Webs
use yii\web\BadRequestHttpException;
use yii\web\Controller;

// Filters
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

// Helpers
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

// Models
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;

/**
 * Class AuthController
 *
 * @package frontend\controllers
 */
class AuthController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            // Генерация рекапчи использая встроенный модуль
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Авторизация пользователя
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('account/index');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Завершение сессия пользователя
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Страница регистрации пользователя
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $countries = \common\models\MapsCountry::find()->select(['id', 'name'])->where(['status' => 1])->asArray()->all();

        $regions = \common\models\MapsRegion::find()->select(['id', 'name'])->where(['status' => 1])->asArray()->all();

        $cities = \common\models\MapsCity::find()->select(['id', 'name'])->where(['status' => 1])->asArray()->all();

        return $this->render('signup', [
            'model' => new SignupForm(),
            'countries' => ArrayHelper::map($countries, 'id', 'name'),
            'regions' => ArrayHelper::map($regions, 'id', 'name'),
            'cities' => ArrayHelper::map($cities, 'id', 'name'),
        ]);
    }

    /**
     * Регистрация пользователя
     *
     * @return \yii\web\Response
     *
     * @throws \yii\base\Exception
     */
    public function actionRegister()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->register()) {
                return $this->redirect(Url::to('auth/login'));
            } else {
                return $this->goHome();
            }
        }

        return $this->redirect(Url::to('auth/signup'));
    }

    /**
     * Форма запроса на сброс пароля
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Форма сброса пароля
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
