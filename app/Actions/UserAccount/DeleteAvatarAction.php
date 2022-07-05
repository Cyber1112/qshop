<?php

namespace App\Actions\UserAccount;

use App\Contracts\DeleteAvatar;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class DeleteAvatarAction implements DeleteAvatar{


    public function execute(): void
    {
        app(Tasks\User\DeleteAvatarTask::class)->run(Auth::user()->id);
    }
}
