<?php

namespace App\Actions\BusinessCity;

use App\Contracts\BusinessCity;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class CreateAction implements BusinessCity{


    public function execute(string $city_id, $business_id): void
    {
        $this->deleteRedundantCity($business_id);

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

    public function deleteRedundantCity($business_id){
        app(Tasks\BusinessCity\DeleteTask::class)->run($business_id);
    }

}
