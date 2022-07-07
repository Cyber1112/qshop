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

        return $this->joinTwoTables(
            $this->getBusinessIdByCategory($category_id),
            $this->getClientBusinessesBonus()
        );

    }

    public function getBusinessIdByCategory(int $category_id){
        $data = app(Tasks\BusinessCategory\GetBusinessByCategoryTask::class)->run(
            $category_id,
            ['businesses.id as business_id', 'businesses.business_name', 'business_bonus_options.bonus_amount']
        );

        return $data->mapWithKeys(function($item, $key){
            return [
                $item['business_id'] => [
                    'business_name' => $item->business_name,
                    'bonus_amount' => $item->bonus_amount
                ]
            ];
        });
    }

    public function getClientBusinessesBonus(){
        $data = app(Tasks\BusinessClientBonus\GetClientActivatedBonusTask::class)->run(
            $this->user,
            ['business_id', 'balance']
        );

        return $data->groupBy('business_id')->map(function ($row){
            return [
                "balance" => $row->sum('balance')
            ];
        });
    }

    public function joinTwoTables($category, $bonus): Collection
    {
        $data = collect();


        foreach ($category->keys() as $key){
            if ($bonus->has($key)){
                $data->push([
                    'business_id' => $key,
                    'business_name' => $category[$key]['business_name'],
                    'balance' => $bonus[$key]['balance']
                ]);
            }else{
                $data->push([
                    'business_id' => $key,
                    'business_name' => $category[$key]['business_name'],
                    'bonus_amount' => $category[$key]['bonus_amount']
                ]);
            }
        }
        return $data;

    }

}
