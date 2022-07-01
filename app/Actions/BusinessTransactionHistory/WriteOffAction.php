<?php

namespace App\Actions\BusinessTransactionHistory;

use App\Contracts\WriteOffBonusFromClient;
use App\Tasks;
use Illuminate\Database\Eloquent\Collection;

class WriteOffAction implements WriteOffBonusFromClient {


    public function execute(Collection $data, int $bonus_amount): void
    {

        $total = $bonus_amount;
        $count = 0;

        while ($total > 0){
            if ($data[$count]['balance'] > $total) {
                app(Tasks\BusinessClientBonus\UpdateTask::class)->run($data[$count]['id'], $data[$count]['balance'] - $total);
                break;
            }
            app(Tasks\BusinessClientBonus\UpdateTask::class)->run($data[$count]['id'], 0, 'used');
            $total -= $data[$count]['balance'];

            $count += 1;
        }

    }



}
