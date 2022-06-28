<?php

namespace App\Actions\BusinessCategory;

use App\Contracts\BusinessCategory;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class CreateAction implements BusinessCategory{

    public function execute(array $categories): void
    {
        foreach ($categories as $category){
            $cat = app(Tasks\Category\FindOrFailTask::class)->run(
                $category
            );

            app(Tasks\BusinessCategory\CreateTask::class)->run(
                [
                    "business_id" => $this->getBusinessId()->id,
                    "category_id" => $cat->id
                ]
            );
        }
    }

    public function getBusinessId(){
        return app(Tasks\Business\FindTask::class)->run(
            Auth::user()->id
        );
    }

}
