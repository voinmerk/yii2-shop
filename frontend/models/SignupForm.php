<?php
namespace frontend\models;

// yii
use yii\base\Model;

// common
use common\models\User;

/**
 * Class SignupForm
 *
 * @package frontend\models
 */
class SignupForm extends Model
{
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $password;
    public $country;
    public $region;
    public $city;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['first_name', 'trim'],
            ['first_name', 'required'],
            ['first_name', 'string', 'max' => 32],

            ['last_name', 'trim'],
            ['last_name', 'required'],
            ['last_name', 'string', 'max' => 32],

            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['country', 'required'],
            ['country', 'integer'],

            ['region', 'required'],
            ['region', 'integer'],

            ['city', 'required'],
            ['city', 'integer'],
        ];
    }

    /**
     * Register user.
     *
     * @return User|null
     *
     * @throws \yii\base\Exception
     */
    public function register()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
