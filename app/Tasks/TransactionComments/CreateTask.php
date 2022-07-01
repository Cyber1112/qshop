<?php

namespace App\Tasks\TransactionComments;

use App\Repositories\TransactionCommentsRepositoryInterface;

class CreateTask{

    private TransactionCommentsRepositoryInterface $comments_repository;

    public function __construct(TransactionCommentsRepositoryInterface $comments_repository)
    {
        $this->comments_repository = $comments_repository;
    }

    public function run(array $payload){
        return $this->comments_repository->create($payload);
    }
}
