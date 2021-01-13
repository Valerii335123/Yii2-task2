<?php

namespace app\models\repository;

use app\models\Record;

class RecordRepository
{
    public function save(Record $record)
    {
        if (!$record->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function findByShare($share)
    {
        return Record::findOne(['share' => $share]);
    }

    public function getById($id)
    {
        $record = Record::findOne($id);
        if ($record == null) {
            throw new \DomainException("Record is not found");
        }
        return $record;
    }

    public function remove($model)
    {
        if (!$model->delete()) {
            throw new \RuntimeException('delete error.');
        }
    }

}

