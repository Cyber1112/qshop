<?php

namespace App\Actions\BusinessCategory;

use App\Contracts\BusinessCategory;
use App\Tasks;
use Illuminate\Support\Facades\Auth;
use App\Helpers;

class CreateAction implements BusinessCategory{

    protected $user;

    public function __construct()
    {
        $this->user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(array $categories): void
    {
        $this->delete($this->user);

        foreach ($categories as $category){
            $cat = app(Tasks\Category\FindOrFailTask::class)->run(
                $category
            );

            app(Tasks\BusinessCategory\CreateTask::class)->run(
                [
                    "business_id" => $this->user,
                    "category_id" => $cat->id
                ]
            );
        }
    }

    public function delete($business_id){
        app(Tasks\BusinessCategory\DeleteTask::class)->run($business_id);
    }

}
