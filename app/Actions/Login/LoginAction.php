<?php
namespace App\Actions\Login;

use App\Contracts\Login;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Tasks;

class LoginAction implements Login{

    /**
     * @param string $phone_number
     * @param string $password
     * @return array
     */
    public function execute(string $phone_number, string $password): array
    {
        /** @var User $user */
        $user = app(Tasks\User\FindByPhoneTask::class)->run($phone_number);

        if (!app(Tasks\User\VerifyPasswordTask::class)->run($user, $password)){
            return [
                'message' => 'Wrong Password'
            ];
        }

        return [
            'phone_number' => $user->phone_number,
            'token' => app(Tasks\User\GenerateTokenTask::class)->run($user)
        ];
    }
}
