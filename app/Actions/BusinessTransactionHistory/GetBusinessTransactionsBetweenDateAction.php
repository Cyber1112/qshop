<?php

namespace App\Actions\BusinessTransactionHistory;

use App\Contracts\GetBusinessTransactionsBetweenDate;
use Illuminate\Support\Collection;
use App\Tasks;

class GetBusinessTransactionsBetweenDateAction implements GetBusinessTransactionsBetweenDate {

    public function execute($business_id, $from, $to): Collection
    {
        $total_sum = app(Tasks\TransactionHistory\GetBusinessTotalSumTransactionTask::class)->run($business_id, $from, $to);
        $count = app(Tasks\TransactionHistory\GetBusinessCountTransactions::class)->run($business_id, $from, $to);

        return collect([
            'total_sum' => $total_sum,
            'count' => $count,
            'average' => (int) ($total_sum / $count),
            'accrued_bonus' => $this->getAccruedBonus($business_id, $from, $to),
            'written_off_bonus' => $this->getWrittenOffBonus($business_id, $from, $to)
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
