<?php

namespace app\controllers;

use Yii;
use app\models\Record;
use app\models\searchModel\RecordSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class RecordController extends Controller
{
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Record();
        $model->active = 1;

        if ($model->load(Yii::$app->request->post())) {
            $model->share = md5(date('Ymdi'));

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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

    public function actionShare($id)
    {
        $model = $this->findModel($id);

        if ($model->active == 0)
            return $this->redirect(['index']);

        return $this->render('share', [
            'share' => $model->share
        ]);
    }

    public function actionChange_active($id)
    {
        $model = $this->findModel($id);

        $model->active = $model->active ? 0 : 1;
        $model->save();

        return $this->redirect(['view', 'id' => $model->id]);
    }

    protected function findModel($id)
    {
        if (($model = Record::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
