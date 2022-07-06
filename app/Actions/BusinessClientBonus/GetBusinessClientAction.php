<?php

namespace App\Actions\BusinessClientBonus;


use App\Contracts\GetBusinessClientBonus;
use Illuminate\Database\Eloquent\Collection;
use App\Tasks;
use App\Helpers;
use Illuminate\Support\Facades\Auth;

class GetBusinessClientAction implements GetBusinessClientBonus {

    protected $user;

    public function __construct()
    {
        $this->user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute($client_id): Collection
    {
        return app(Tasks\BusinessClientBonus\FindTask::class)->run($client_id, $this->user);
    }
}
