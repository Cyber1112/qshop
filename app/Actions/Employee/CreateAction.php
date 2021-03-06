<?php

namespace App\Actions\Employee;

use App\Contracts\AddEmployee;
use App\Dto\BusinessEmployee\CreateDto;
use App\Tasks;
use Illuminate\Support\Facades\Auth;
use App\Helpers;


class CreateAction implements AddEmployee{

    protected $user;

    public function __construct()
    {
        $this->user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(CreateDto $dto): void
    {
        $this->createUser([
            "phone_number" => $dto->phone_number,
            "name" => $dto->name,
            "password" => $dto->password
        ]);

        $user = $this->getUserId($dto->phone_number);

        $this->createEmployee([
            "position" => $dto->position,
            "business_id" => $this->user,
            "user_id" => $user->id
        ]);

        $this->assignRole($user, 'employee');
        $this->assignPermissionsToUser($user, $dto->permissions);

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
