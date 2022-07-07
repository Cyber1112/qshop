<?php

namespace App\Actions\BusinessTransactionHistory;

use App\Contracts\WriteOffBonusFromClient;
use App\Tasks;
use App\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WriteOffAction implements WriteOffBonusFromClient {

    protected $user;

    public function __construct()
    {
       $this->user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(string $phone_number, int $bonus_amount): void
    {
        $client = app(Tasks\User\FindByPhoneTask::class)->run($phone_number);

        $this->ensureThatUserExists($client);

        $client_id = $this->getClientId($client->id);

        $total = $bonus_amount;
        $count = 0;

        $data = $this->getBusinessClientData($client_id);

        while ($total > 0){
            if ($data[$count]['balance'] > $total) {
                app(Tasks\BusinessClientBonus\UpdateTask::class)->run($data[$count]['id'], $data[$count]['balance'] - $total);
                break;
            }
            app(Tasks\BusinessClientBonus\DeleteClientBonusTask::class)->run($data[$count]['id']);
            $total -= $data[$count]['balance'];

            $count += 1;
        }
        $this->setWrittenOffBonus($data[0]['business_id'], $data[0]['client_id'], $bonus_amount);
    }

    public function setWrittenOffBonus($business_id, $client_id, $bonus_amount){
        app(Tasks\BusinessClientWrittenOffTransaction\CreateTask::class)->run(
            [
                'written_off_bonus' => $bonus_amount,
                'business_id' => $business_id,
                'client_id' => $client_id
            ]
        );
    }

    public function getBusinessClientData($client_id): Collection{
        return app(Tasks\BusinessClientBonus\FindTask::class)->run($client_id, $this->user);
    }


    public function getClientId($user_id): int
    {
        return app(Tasks\Client\FindTask::class)->run($user_id)->id;
    }

    public function ensureThatUserExists($user){
        if (!$user){
            throw new NotFoundHttpException("The user is not found");
        }
    }



}
