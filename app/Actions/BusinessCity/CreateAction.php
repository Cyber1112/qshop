<?php

namespace App\Actions\BusinessCity;

use App\Contracts\BusinessCity;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class CreateAction implements BusinessCity{


    public function execute(string $city_id, $business_id): void
    {

        $city = app(Tasks\City\FindTask::class)->run(
            $city_id
        );

        app(Tasks\BusinessCity\CreateTask::class)->run(
            [
                "business_id" => $business_id,
                "city_id" => $city->id
            ]
        );
    }

}
