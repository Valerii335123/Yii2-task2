<?php

namespace app\models\service;


use app\models\Record;
use app\models\repository\RecordRepository;

class RecordService
{

    private $recordRepository;

    public function __construct(RecordRepository $recordRepository)
    {
        $this->recordRepository = $recordRepository;
    }

    public function create(Record $record)
    {
        $record->share = md5(date('Ymdi'));
        $this->recordRepository->save($record);
    }

    public function delete($id)
    {
        $model = $this->recordRepository->get($id);
        $this->recordRepository->remove($model);
    }

    public function getShared($id)
    {
        $model = $this->recordRepository->get($id);

        if (!$model->isAcive()) {
            \Yii::$app->response->redirect('index');
        }

        return $model;
    }


    public function changeActive($id)
    {
        $model = $this->recordRepository->get($id);
        $model->active = $model->isAcive() ? 0 : 1;
        $this->recordRepository->save($model);

    }
}

?>