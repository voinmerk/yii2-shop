<?php

namespace backend\controllers;

// Yii
use Yii;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// App
use backend\models\Category;
use backend\models\CategorySearch;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Список всех категорий
     * 
     * @return mixed
     */
    public function actionIndex()
    {
        /*$searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/

        $data = [];

        $query = Category::getCategories();
        $pages = new \yii\data\Pagination(['totalCount' => $query->count()]);
        $categories = $query->offset($pages->offset)->limit($pages->limit)->all();

        $data['categories'] = $categories;
        $data['pages'] = $pages;

        if(Yii::$app->session->hasFlash('success')) {
            $data['success'] = Yii::$app->session->getFlash('success');
        }

        if(Yii::$app->session->hasFlash('error_warning')) {
            $data['error_warning'] = Yii::$app->session->getFlash('error_warning');
        }

        return $this->render('index', $data);
    }

    /**
     * Просмотр содержимого выбранной категории
     * 
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $data = [];

        $data['model'] = $this->findModel($id);

        if(Yii::$app->session->hasFlash('error_warning')) {
            $data['error_warning'] = Yii::$app->session->getFlash('error_warning');
        }

        return $this->render('view', $data);
    }
    /**
     * Создание новой категории
     * 
     * If creation is successful, the browser will be redirected to the 'view' page.
     * 
     * @return mixed
     */
    public function actionCreate()
    {
        $data = [];

        $model = new Category();

        $categories = Category::getCategoryTree();

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()) {
                
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $data['error_warning'] = 'Вы не прошли проверку введённых данных!';
            }
        } else {
            $data['error_warning'] = 'Заполните все поля формы!';
        }

        if(Yii::$app->session->hasFlash('error_warning')) {
            $data['error_warning'] = Yii::$app->session->getFlash('error_warning');
        }

        var_dump($categories);
        exit;

        $data['model'] = $model;
        $data['categories'] = $categories;

        return $this->render('create', $data);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * 
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $data = [];

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'Категория успешно сохранена!');

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $data['error_warning'] = 'Вы не прошли проверку введённых данных!';
            }
        } else {
            $data['error_warning'] = 'Заполните все поля формы!';
        }

        if(Yii::$app->session->hasFlash('error_warning')) {
            $data['error_warning'] = Yii::$app->session->getFlash('error_warning');
        }

        $data['model'] = $model;

        return $this->render('update', $data);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * 
     * @param array|int $selected
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($selected)
    {
        if(!empty($selected)) {
            if(is_array($selected)) {
                foreach($selected as $id) {
                    $this->findModel($id)->delete();
                }

                Yii::$app->session->setFlash('success', 'Выбранные записи успешно удалены!');
            } else {
                $this->findModel($selected)->delete();

                Yii::$app->session->setFlash('success', 'Выбранная категория успешно удалена!');
            }
        } else {
            Yii::$app->session->setFlash('error_warning', 'Вы не выбрали элементы для удаления!');
        }

        return $this->redirect(['index']);
    }

    /**
     * Copy an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * 
     * @param array|int $selected
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCopy($selected)
    {
        if(!empty($selected)) {
            if(is_array($selected)) {
                foreach($selected as $id) {
                    $this->findModel($id)->save();
                }
            } else {
                $this->findModel($selected)->save();
            }

            Yii::$app->session->setFlash('success', 'Выбранные записи успешно копированы!');
        } else {
            Yii::$app->session->setFlash('error_warning', 'Вы не выбрали элементы для копирования!');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * 
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
