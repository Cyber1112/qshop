<?php

namespace App\Tasks\User;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class FindByPhoneTask
{
    public UserRepositoryInterface $user_repository;

    public function __construct(UserRepositoryInterface $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    /**
     * @param string $phone_number
     * @return User|null
     */
    public function run(string $phone_number): ?User
    {
        return $this->user_repository->findByPhone($phone_number);
    }
}
