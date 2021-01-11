<?php

namespace app\models\repository;

use app\models\Comment;

class CommentRepository
{
    public function save(Comment $comment)
    {
        if (!$comment->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

}

?>