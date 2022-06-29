<?php

namespace App\Contracts;

interface BusinessCity{

    public function execute(string $city_id, int $business_id): void;

}
