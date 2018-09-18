<?php
namespace backend\behaviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

use common\models\User;

/**
 * UserBehavior class
 */
class UserBehavior extends Behavior
{
	public $user;
}