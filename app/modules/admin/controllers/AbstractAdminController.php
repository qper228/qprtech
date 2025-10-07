<?php

namespace app\modules\admin\controllers;

use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

abstract class AbstractAdminController extends Controller
{
    protected $searchModel = null;
    protected $model = null;

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        if (!$this->searchModel || !$this->model) {
            throw new InvalidArgumentException(
                'You have to override `searchModel` & `model` attribute in child class'
            );
        }
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'options' => ['GET'],
                    ],
                ],
            ],
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        ['allow' => true, 'roles' => ['admin']],
                    ],
                ]
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new $this->searchModel();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new $this->model;
        $model->scenario = 'create';
        if ($this->request->isPost) {
            if (
                $model->load($this->request->post()) &&
                $model->validate() &&
                $model->save()
            ) {
                Yii::$app->session->setFlash('recordCreated');
                return $this->actionIndex();
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        if (
            $this->request->isPost &&
            $model->load($this->request->post()) &&
            $model->validate() &&
            $model->save()
        ) {
            Yii::$app->session->setFlash('recordUpdated');
            return $this->actionIndex();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    private function findModel($id)
    {
        $model = $this->model;
        if (($record = $model::findOne(['id' => $id])) !== null) {
            return $record;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}