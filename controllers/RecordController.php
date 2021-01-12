<?php

namespace app\controllers;

use app\models\repository\RecordRepository;
use app\models\service\RecordService;
use Yii;
use app\models\Record;
use app\models\searchModel\RecordSearch;
use yii\filters\AccessControl;
use yii\web\Controller;


class RecordController extends Controller
{
    private $recordService;
    private $recordRepository;

    public function __construct($id, $module, RecordService $service, RecordRepository $recordRepository, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->recordService = $service;
        $this->recordRepository = $recordRepository;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        'roles' => ['?'],
                        'denyCallback' => function () {

                            return $this->redirect('user/login');
                        },
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new RecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->recordRepository->getById($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Record();
        $model->active = 1;

        if ($model->load(Yii::$app->request->post())) {
            $this->recordService->create($model);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->recordRepository->getById($id);

        if ($model->load(Yii::$app->request->post())) {
            $this->recordRepository->save($model);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->recordService->delete($id);

        return $this->redirect(['index']);
    }

    public function actionShare($id)
    {
        $model = $this->recordService->getShared($id);

        return $this->render('share', [
            'share' => $model->share
        ]);
    }

    public function actionChange_active($id)
    {
        $this->recordService->changeActive($id);

        return $this->redirect(['view', 'id' => $id]);
    }


}
