<?php

namespace App\Actions\BusinessTransactionHistory;

use App\Contracts\Transaction;
use App\Dto\BusinessTransaction\CreateDto;
use App\Tasks;
use Carbon\Carbon;
use App\Helpers;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CreateAction implements Transaction{

    protected $business_id;

    public function __construct()
    {
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(CreateDto $dto): void
    {
        $client = app(Tasks\User\FindByPhoneTask::class)->run($dto->phone_number);

        $this->ensureThatUserExists($client);
        $this->ensureThatBalanceIsEnough($dto->purchase_amount);

        $client_id = $this->getClientId($client->id);



        $bonus_option = $this->getBonusOptions($this->business_id);

        $this->writeOffMoneyFromBusiness($this->business_id, $dto->purchase_amount);

        $this->sendBonusToClient(
            $client_id,
            $this->business_id,
            $this->setBonusAmount($dto->bonus_amount, $dto->purchase_amount),
            $this->setDate($bonus_option['activation_bonus_period']),
            $this->setDeactivationDate($bonus_option)
        );

        $this->addToTransactionHistory($dto, $this->business_id, $client_id);

    }

    public function ensureThatUserExists($user){
        if (!$user){
            throw new NotFoundHttpException("The user is not found");
        }
    }

    public function ensureThatBalanceIsEnough($purchase_amount){
        if (app(Tasks\Business\FindBusinessTask::class)->run($this->business_id)->balance < $purchase_amount) {
            throw new AccessDeniedHttpException("Not enough money");
        }
    }

    public function setDeactivationDate($bonus_option){
        return $bonus_option['deactivation_bonus_period'] == null ? null : $this->setDate($bonus_option['deactivation_bonus_period'] + $bonus_option['activation_bonus_period']);
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

    public function getClientId($user_id): int
    {
        return app(Tasks\Client\FindTask::class)->run($user_id)->id;
    }

}
