<?php

namespace App\Actions\BusinessCity;

use App\Contracts\BusinessCity;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class CreateAction implements BusinessCity{


    public function execute(string $city_id): void
    {

        $city = app(Tasks\City\FindTask::class)->run(
            $city_id
        );

        app(Tasks\BusinessCity\CreateTask::class)->run(
            [
                "business_id" => $this->getBusinessId()->id,
                "city_id" => $city->id
            ]
        );
    }

    public function getBusinessId(){
        return app(Tasks\Business\FindTask::class)->run(
            Auth::user()->id
        );
    }
}
