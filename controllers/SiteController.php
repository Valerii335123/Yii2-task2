<?php

namespace app\controllers;

use app\models\forms\CommentForm;
use app\models\Record;
use app\models\searchModel\CommentSearch;
use app\models\service\CommentService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{

    private $commentService;

    public function __construct($id, $module, CommentService $commentService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->commentService = $commentService;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('record/index');
        }

        return $this->render('index');
    }

    public function actionError()
    {
        return $this->render('error');
    }

    public function actionShared($share)
    {
        $record = Record::findOne(['share' => $share]);
        $commentForm = new CommentForm();

        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $record);

        if ($commentForm->load(Yii::$app->request->post())) {
            $this->commentService->create($commentForm, $record->id);
        }

        $commentForm->comment = '';

        return $this->render('view_record', [
            'dataProvider' => $dataProvider,
            'commentForm' => $commentForm,
            'record' => $record

        ]);
    }

}
