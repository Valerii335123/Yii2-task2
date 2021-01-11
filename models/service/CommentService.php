<?php

namespace app\models\service;

use app\models\Comment;
use app\models\repository\CommentRepository;


class CommentService
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function create($commentForm, $id)
    {
        $comment = new Comment();
        $comment->create($commentForm, $id);
        $this->commentRepository->save($comment);
    }

}

?>