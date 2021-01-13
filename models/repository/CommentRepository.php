<?php

namespace app\models\repository;

use app\models\Comment;

use yii\web\NotFoundHttpException;

class CommentRepository
{
    public function save(Comment $comment)
    {
        if (!$comment->save()) {
            throw new NotFoundHttpException("error save comment");
        }
    }

}

?>