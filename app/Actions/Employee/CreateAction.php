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
        array $permissions,
        int $business_id
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
            "business_id" => $business_id,
            "user_id" => $user->id
        ]);

        $this->assignRole($user, 'employee');
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

    public function assignRole($user, $role){
        app(Tasks\User\AssignRoleTask::class)->run($user, $role);
    }

    public function getUserId($phone_number){
        return app(Tasks\User\FindByPhoneTask::class)->run($phone_number);
    }

}
