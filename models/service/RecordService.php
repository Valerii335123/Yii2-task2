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
        $model = $this->recordRepository->getById($id);
        $this->recordRepository->remove($model);
    }

    public function getShared($id)
    {
        $model = $this->recordRepository->getById($id);

        if (!$model->isAcive()) {
            \Yii::$app->response->redirect('index');
        }

        return $model;
    }


    public function changeActive($id)
    {
        $model = $this->recordRepository->getById($id);
        $model->active = $model->isAcive() ? Record::RECORD_INACTIVE : Record::RECORD_ACTIVE;
        $this->recordRepository->save($model);

    }
}

?>