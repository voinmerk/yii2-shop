<?php
 
namespace common\components;
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
 
class Config extends Component
{
    private $_attributes;

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        $this->_attributes = ArrayHelper::map(\common\models\Config::find()->all(), 'name', 'value');
    }

    public function __get($name) {
        if (array_key_exists($name, $this->_attributes))
            return $this->_attributes[$name];
 
        return parent::__get($name);
    }
}