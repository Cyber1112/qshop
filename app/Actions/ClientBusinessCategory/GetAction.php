<?php

namespace App\Actions\ClientBusinessCategory;

use App\Contracts\GetClientBusinessCategory;
use Illuminate\Support\Collection;
use App\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Tasks;

class GetAction implements GetClientBusinessCategory{

    protected $user;

    public function __construct()
    {
        $this->user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(int $category_id): Collection
    {

//        return $this->bonusOptions($this->getBusinessIdByCategory($category_id));
        return $this->getBusinessIdByCategory($category_id);
    }

    public function getBusinessIdByCategory(int $category_id){
        return app(Tasks\BusinessCategory\GetBusinessByCategoryTask::class)->run(
            $category_id,
            ['businesses.id']
        );
    }

    public function bonusOptions($businesses){
        $data = collect();
        $business_options = app(Tasks\Business\GetBusinessBonusOptions::class)->run([
            'business_bonus_options.bonus_amount',
            'businesses.id',
            'businesses.business_name'
        ]);

        return $business_options;

    }
}
