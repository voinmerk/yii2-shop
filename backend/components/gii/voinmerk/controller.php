<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?php if (!empty($generator->searchModelClass)): ?>
use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>
use yii\data\ActiveDataProvider;
<?php endif; ?>
use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
 */
class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'copy' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all <?= $modelClass ?> models.
     * @return mixed
     */
    public function actionIndex()
    {
        $data = [];

        $session = Yii::$app->session;

        if($session->hasFlash('success')) {
            $data['success'] = $session->getFlash('success');
        }

        if($session->hasFlash('error_warning')) {
            $data['error_warning'] = $session->getFlash('error_warning');
        }
<?php if (!empty($generator->searchModelClass)): ?>
        $searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $data['searchModel'] = $searchModel;
        $data['dataProvider'] = $dataProvider;
<?php else: ?>
        $dataProvider = new ActiveDataProvider([
            'query' => <?= $modelClass ?>::find(),
        ]);

        $data['dataProvider'] => $dataProvider;
<?php endif; ?>

        return $this->render('index', $data);
    }

    /**
     * Displays a single <?= $modelClass ?> model.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     */
    public function actionView(<?= $actionParams ?>)
    {
        $data = [];

        $session = Yii::$app->session;

        if($session->hasFlash('success')) {
            $data['success'] = $session->getFlash('success');
        }

        if($session->hasFlash('error_warning')) {
            $data['error_warning'] = $session->getFlash('error_warning');
        }

        $data['model'] => $this->findModel(<?= $actionParams ?>),

        return $this->render('view', $data);
    }

    /**
     * Creates a new <?= $modelClass ?> model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new <?= $modelClass ?>();

        /*$data = [];

        $session = Yii::$app->session;

        if($session->hasFlash('error_warning')) {
            $data['error_warning'] = $session->getFlash('error_warning');
        }*/

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', <?= $urlParams ?>]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing <?= $modelClass ?> model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     */
    public function actionUpdate(<?= $actionParams ?>)
    {
        $model = $this->findModel(<?= $actionParams ?>);

        /*$data = [];

        $session = Yii::$app->session;

        if($session->hasFlash('error_warning')) {
            $data['error_warning'] = $session->getFlash('error_warning');
        }*/

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', <?= $urlParams ?>]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing <?= $modelClass ?> model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     */
    public function actionDelete($selected)
    {
        $session = Yii::$app->session;

        if(is_array($selected)) {
            if(empty($selected)) {
                $session->setFlash('error_warning', 'Вы не выбрали ни одну запись для копирования!');

                return $this->redirect(['index']);
            }

            $deleted = 0;

            foreach($selected as $id) {
                if($this->findModel($id)->delete()) $deleted++;
            }

            if($deleted) {
                $session->setFlash('success', 'Запись(и) успешно удалена(ы)!');
            } else {
                $session->setFlash('error_warning', 'Запись не может быть удалена!');
            }
        } else {
            if($this->findModel($selected)->save()) {
                $session->setFlash('success', 'Запись успешно удалена!');
            } else {
                $session->setFlash('error_warning', 'Запись не может быть удалена!');
            }
        }

        return $this->redirect(['index']);
    }

    public function actionCopy($selected)
    {
        $session = Yii::$app->session;

        if(is_array($selected)) {
            if(empty($selected)) {
                $session->setFlash('error_warning', 'Вы не выбрали ни одну запись для копирования!');

                return $this->redirect(['index']);
            }

            $saved = 0;

            foreach($selected as $id) {
                if($this->findModel($id)->save()) $saved++;
            }

            if($saved) {
                $session->setFlash('success', 'Запись(и) успешно копирована(ы)!');
            } else {
                $session->setFlash('error_warning', 'Запись не может быть копирована!');
            }
        } else {
            if($this->findModel($selected)->save()) {
                $session->setFlash('success', 'Запись успешно копирована!');
            } else {
                $session->setFlash('error_warning', 'Запись не может быть копирована!');
            }

            return $this->redirect(['view', 'id' => $selected]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the <?= $modelClass ?> model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return <?=                   $modelClass ?> the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(<?= $actionParams ?>)
    {
<?php
if (count($pks) === 1) {
    $condition = '$id';
} else {
    $condition = [];
    foreach ($pks as $pk) {
        $condition[] = "'$pk' => \$$pk";
    }
    $condition = '[' . implode(', ', $condition) . ']';
}
?>
        if (($model = <?= $modelClass ?>::findOne(<?= $condition ?>)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
