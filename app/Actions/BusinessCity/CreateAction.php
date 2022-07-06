<?php

namespace App\Actions\BusinessCity;

use App\Contracts\BusinessCity;
use App\Tasks;
use Illuminate\Support\Facades\Auth;
use App\Helpers;

class CreateAction implements BusinessCity{

    protected $user;

    public function __construct()
    {
        $this->user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(string $city_id): void
    {
        $this->deleteRedundantCity($this->user);

        $city = app(Tasks\City\FindTask::class)->run(
            $city_id
        );

        app(Tasks\BusinessCity\CreateTask::class)->run(
            [
                "business_id" => $this->user,
                "city_id" => $city->id
            ]
        );
    }

    public function deleteRedundantCity($business_id){
        app(Tasks\BusinessCity\DeleteTask::class)->run($business_id);
    }

}
