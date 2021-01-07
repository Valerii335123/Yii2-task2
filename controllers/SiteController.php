<?php

namespace app\controllers;

use app\models\Comment;
use app\models\forms\CommentForm;
use app\models\Record;
use app\models\searchModel\CommentSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;


class SiteController extends Controller
{
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

        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $record);

        $commentForm = new CommentForm();

        if ($commentForm->load(Yii::$app->request->post())) {
            $comment = new Comment();
            $comment->create($commentForm, $record->id);
            $comment->save();
        }

        $commentForm->comment = '';

        return $this->render('view_record', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'commentForm' => $commentForm,
            'record' => $record

        ]);
    }


}
