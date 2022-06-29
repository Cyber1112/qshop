<?php

namespace App\Actions\BusinessCategory;

use App\Contracts\BusinessCategory;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class CreateAction implements BusinessCategory{

    public function execute(array $categories, int $business_id): void
    {
        $this->delete($business_id);

        foreach ($categories as $category){
            $cat = app(Tasks\Category\FindOrFailTask::class)->run(
                $category
            );

            app(Tasks\BusinessCategory\CreateTask::class)->run(
                [
                    "business_id" => $business_id,
                    "category_id" => $cat->id
                ]
            );
        }
    }

    public function delete($business_id){
        app(Tasks\BusinessCategory\DeleteTask::class)->run($business_id);
    }

}
