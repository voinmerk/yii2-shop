<?php
namespace frontend\components;

use yii\web\UrlRuleInterface;
use yii\base\BaseObject;

use common\models\Aliases;

class AliasesUrlRule extends BaseObject implements UrlRuleInterface
{
    public function createUrl($manager, $route, $params)
    {
        return false;
    }

    public function parseRequest($manager, $request)
    {
        $url = trim($request->pathInfo, '/');

        $model = Aliases::find()->where(['alias' => $url])->one();

        if (empty($model)) {
            return false;
        }

        return [$model->controller . '/' . $model->action, ['slug' => $model->alias]];
    }
}
