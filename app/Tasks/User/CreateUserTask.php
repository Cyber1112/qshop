<?php

namespace App\Tasks\User;

use App\Repositories\UserRepositoryInterface;

class CreateUserTask{

    private UserRepositoryInterface $user_repository;

    public function __construct(UserRepositoryInterface $userRepository){
        $this->user_repository = $userRepository;
    }

    public function run(array $payload){
        $this->user_repository->create($payload);
    }

}
