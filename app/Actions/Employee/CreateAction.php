<?php

namespace App\Actions\Employee;

use App\Contracts\AddEmployee;
use App\Tasks;
use Illuminate\Support\Facades\Auth;


class CreateAction implements AddEmployee{
    public function execute(
        string $phone_number,
        string $name,
        string $position,
        string $password,
        array $permissions
    ): void
    {
        $this->createUser([
            "phone_number" => $phone_number,
            "name" => $name,
            "password" => $password
        ]);

        $user = $this->getUserId($phone_number);

        $this->createEmployee([
            "position" => $position,
            "business_id" => $this->getBusinessId()->id,
            "user_id" => $user->id
        ]);

        $this->assignPermissionsToUser($user, $permissions);

    }

    /**
     * @param array $payload
     * @return void
     */
    public function createUser(array $payload): void
    {
        app(Tasks\User\CreateUserTask::class)->run($payload);
    }

    public function createEmployee(array $payload){
        app(Tasks\Employee\CreateEmployeeTask::class)->run($payload);
    }

    public function assignPermissionsToUser($user, array $permissions){
        app(Tasks\Employee\GivePermissionsTask::class)->run(
            $user, $permissions
        );
    }

    public function getUserId($phone_number){
        return app(Tasks\User\FindByPhoneTask::class)->run($phone_number);
    }

    public function getBusinessId(){
        return app(Tasks\Business\FindTask::class)->run(
            Auth::user()->id
        );
    }


}
