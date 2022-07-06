<?php

namespace App\Actions\BusinessTransactionHistory;

use App\Contracts\GetBusinessTransactionsBetweenDate;
use Illuminate\Support\Collection;
use App\Tasks;
use Illuminate\Support\Facades\Auth;
use App\Helpers;

class GetBusinessTransactionsBetweenDateAction implements GetBusinessTransactionsBetweenDate {

    protected $user;

    public function __construct()
    {
        $this->user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(string $from, string $to): Collection
    {
        $total_sum = app(Tasks\TransactionHistory\GetBusinessTotalSumTransactionTask::class)->run($this->user, $from, $to);
        $count = app(Tasks\TransactionHistory\GetBusinessCountTransactions::class)->run($this->user, $from, $to);

        return collect([
            'total_sum' => $total_sum,
            'count' => $count,
            'average' => (int) ($total_sum / $count),
            'accrued_bonus' => $this->getAccruedBonus($this->user, $from, $to),
            'written_off_bonus' => $this->getWrittenOffBonus($this->user, $from, $to)
        ]);
    }

    public function getAccruedBonus($business_id, $from, $to): int
    {
        $data = app(Tasks\TransactionHistory\GetPurchaseAndBonusAmountTask::class)->run($business_id, $from, $to);

        $accrued_bonus = 0;

        foreach ($data as $value){
            $accrued_bonus += (int) (($value['purchase_amount'] * $value['bonus_amount'])/100);
        }
        return $accrued_bonus;
    }

    public function getWrittenOffBonus($business_id, $from, $to): int
    {
        return app(Tasks\BusinessClientWrittenOffTransaction\GetWrittenOffBonusTask::class)->run($business_id, $from, $to);
    }

}
