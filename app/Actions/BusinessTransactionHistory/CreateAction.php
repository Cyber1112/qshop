<?php

namespace App\Actions\BusinessTransactionHistory;

use App\Contracts\Transaction;
use App\Dto\BusinessTransaction\CreateDto;
use App\Tasks;

class CreateAction implements Transaction{

    public function execute(CreateDto $dto, int $business_id, int $client_id): void
    {

        $this->writeOffMoneyFromBusiness($business_id, $dto->purchase_amount);
        $this->sendBonusToClient($client_id, (int) (($dto->bonus_amount * $dto->purchase_amount) / 100));
        $this->addToTransactionHistory($dto, $business_id, $client_id);
    }

    public function sendBonusToClient($client_id, $bonus_amount){
        app(Tasks\Client\IncrementBonusTask::class)->run($client_id, $bonus_amount);
    }

    public function setComment(){}

    public function writeOffMoneyFromBusiness($business_id, $purchase_amount){
        app(Tasks\Business\WriteOffMoneyTask::class)->run($business_id, $purchase_amount);
    }

    public function addToTransactionHistory($dto, $business_id, $client_id){
        app(Tasks\TransactionHistory\CreateTask::class)->run(
            [
                'bonus_amount' => $dto->bonus_amount,
                'purchase_amount' => $dto->purchase_amount,
                'business_id' => $business_id,
                'client_id' => $client_id
            ]
        );
    }



}
