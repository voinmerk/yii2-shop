<?php
namespace frontend\components\aliases;

// Yii core
use Yii;
use yii\caching\DbDependency;
use yii\web\CompositeUrlRule;
use yii\web\UrlRuleInterface;
use yii\base\InvalidConfigException;

// Models
use frontend\models\Aliases;

/**
 * Class AliasesUrlRule
 *
 * @package frontend\components\Aliases
 */
class AliasesUrlRule extends CompositeUrlRule
{
    public $cacheComponent = 'cache';
    public $cacheID = 'AliasesUrlRules';
    public $ruleConfig = [
        'class' => 'yii\web\UrlRule'
    ];

    /**
     * Creates the URL rules that should be contained within this composite rule.
     *
     * @return void|UrlRuleInterface[]
     *
     * @throws InvalidConfigException
     */
    protected function createRules()
    {
        $cache = Yii::$app->get($this->cacheComponent)->get($this->cacheID);

        if (!empty($cache)) return $cache;

        $aliases = Aliases::find()->asArray(true)->all();

        $rules = [];

        foreach ($aliases as $alias) {
            $rule = [
                'pattern' => ltrim($alias['alias'], '/'),
                'route' => ltrim($alias['route'], '/'),
            ];

            $rule = Yii::createObject(array_merge($this->ruleConfig, $rule));

            if (!$rule instanceof UrlRuleInterface) {
                throw new InvalidConfigException('URL rule class must implement UrlRuleInterface.');
            }

            $rules[] = $rule;
        }

        $cd = new DbDependency();
        $cd->sql = "SELECT MAX(id) FROM " . Aliases::tableName();

        Yii::$app->get($this->cacheComponent)->set($this->cacheID, $rules, 60, $cd);

        return $rules;
    }

    public function __wakeup()
    {
        $this->init();
    }
}