<?php

namespace App\Actions\Statistics;

use App\Contracts\GetStatistics;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Tasks;
use App\Helpers;
use Illuminate\Support\Facades\Auth;

class GetStatisticsAction implements GetStatistics{

    protected $user;

    public function __construct()
    {
        $this->user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(string $period): Collection
    {
        $data = app(Tasks\TransactionHistory\GetBusinessTransactions::class)->run($this->user);

        $data =  $this->convertDate($data);

        $info = collect();

        switch ($period){
            case 'week':
                $info = $this->getByWeek($data);
                break;

            case 'month':
                $info = $this->getByMonth($data);
                break;

            case 'three month':
                $info = $this->getByThreeMonth($data);
                break;

            case 'half year':
                $info = $this->getByHalfYear($data);
                break;

            default:
                $info = "";
        }

        return $info;
    }

    public function convertDate($data){
        $new_collection = collect();
        $data->map(function($item, $key) use ($new_collection){
            $new_collection->push([
                'purchase_amount' => $item['purchase_amount'],
                'created_at' => date('Y-m-d', strtotime($item['created_at']))
            ]);
        });
        return $new_collection;
    }

    public function getByWeek($data){
        $filteredData = $data->filter(function($value){
            return $value['created_at'] > Carbon::now()->subDays(7);
        });

        return $filteredData->groupBy('created_at')->map(function($row){
            return $row->sum('purchase_amount');
        });
    }

    public function getByMonth($data){
        $filteredData = $data->filter(function($value){
            return $value['created_at'] > Carbon::now()->subDays(30);
        });

        return 1;
    }

    public function getByThreeMonth($data){
        return 1;
    }

    public function getByHalfYear($data){
        return 1;
    }
}
