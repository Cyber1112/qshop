<?php

namespace App\Contracts;

interface WriteOffBonusFromClient{

    public function execute(int $client_id, int $bonus_amount): void;

}
