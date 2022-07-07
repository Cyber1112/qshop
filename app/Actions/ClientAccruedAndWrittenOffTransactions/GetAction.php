<?php

namespace App\Actions\ClientAccruedAndWrittenOffTransactions;

use App\Contracts\GetAccruedAndWrittenOffTransactions;
use Illuminate\Support\Collection;
use App\Helpers;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class GetAction implements GetAccruedAndWrittenOffTransactions{

    protected $user;

    public function __construct()
    {
        $this->user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(string $from, string $to): Collection
    {

        return collect([
            'Accrued' => $this->getAccruedBonus($from, $to),
            'Written_off' => $this->getWrittenOffBonus($from, $to)
        ]);
    }

    public function getAccruedBonus($from, $to): Collection
    {
        $data = app(Tasks\TransactionHistory\GetClientTransactionsTask::class)->run(
            $this->user,
            $from,
            $to,
            ['businesses.business_name', 'transaction_histories.purchase_amount',
                'transaction_histories.bonus_amount', 'transaction_histories.created_at',
                'transaction_histories.id']
        );
        $new_collection = collect();
        $data->map(function($item, $key) use ($new_collection){
            $new_collection->push([
                'id' => $item['id'],
                'business_name' => $item['business_name'],
                'bonus' => (int) (( $item['purchase_amount'] * $item['bonus_amount'])/100),
                'created_at' => date('Y-m-d', strtotime($item['created_at']))
            ]);
        });

        return $new_collection;
    }

    public function getWrittenOffBonus($from, $to): Collection
    {
        $data = app(Tasks\BusinessClientWrittenOffTransaction\GetClientWrittenOffBonus::class)->run(
            $this->user,
            $from,
            $to,
            ['businesses.business_name', 'business_client_wrote_off_transactions.written_off_bonus',
                'business_client_wrote_off_transactions.created_at', 'business_client_wrote_off_transactions.id']
        );
        $new_collection = collect();
        $data->map(function($item, $key) use ($new_collection){
            $new_collection->push([
                'id' => $item['id'],
                'business_name' => $item['business_name'],
                'written_off_bonus' => $item['written_off_bonus'],
                'created_at' => date('Y-m-d', strtotime($item['created_at']))
            ]);
        });
        return $new_collection;
    }
}
