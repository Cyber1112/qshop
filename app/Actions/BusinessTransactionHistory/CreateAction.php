<?php

namespace App\Actions\BusinessTransactionHistory;

use App\Contracts\Transaction;
use App\Dto\BusinessTransaction\CreateDto;
use App\Tasks;
use Carbon\Carbon;

class CreateAction implements Transaction{

    public function execute(CreateDto $dto, int $business_id, int $client_id): void
    {
        $bonus_option = $this->getBonusOptions($business_id);

        $this->writeOffMoneyFromBusiness($business_id, $dto->purchase_amount);

        $deactivation_date = $bonus_option['deactivation_bonus_period'] == null ? null : $this->setDate($bonus_option['deactivation_bonus_period'] + $bonus_option['activation_bonus_period']);

        $this->sendBonusToClient(
            $client_id,
            $business_id,
            $this->setBonusAmount($dto->bonus_amount, $dto->purchase_amount),
            $this->setDate($bonus_option['activation_bonus_period']),
            $deactivation_date
        );

        $this->addToTransactionHistory($dto, $business_id, $client_id);

    }

    public function sendBonusToClient($client_id, $business_id, $bonus_amount, $activation_date, $deactivation_date = null){

        app(Tasks\BusinessClientBonus\CreateTask::class)->run([
            'client_id' => $client_id,
            'business_id' => $business_id,
            'balance' => $bonus_amount,
            'activation_bonus_date' => $activation_date,
            'deactivation_bonus_date' => $deactivation_date
        ]);

    }

    public function getBonusOptions($business_id){
        return app(Tasks\BusinessBonusOption\FindTask::class)->run($business_id);
    }

    public function setDate($days){
        return Carbon::now()->addDays($days);
    }

    public function setBonusAmount($bonus_amount, $purchase_amount): int
    {
        return (int) (($bonus_amount*$purchase_amount)/100);
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
