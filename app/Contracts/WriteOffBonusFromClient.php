<?php

namespace App\Contracts;


interface WriteOffBonusFromClient{

    public function execute(string $phone_number, int $bonus_amount): void;

}
