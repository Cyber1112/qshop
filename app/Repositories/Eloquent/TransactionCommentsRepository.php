<?php

namespace App\Repositories\Eloquent;

use App\Models\TransactionComment;
use App\Repositories\TransactionCommentsRepositoryInterface;

class TransactionCommentsRepository extends BaseRepository implements TransactionCommentsRepositoryInterface{

    public function __construct(TransactionComment $model){
        $this->model = $model;
    }

}
