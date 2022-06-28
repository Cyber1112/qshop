<?php

namespace App\Contracts;

use App\Dto\BusinessSchedule\CreateDto;

interface BusinessSchedule{

//    /**
//     * @param array $request
//     * @return void
//     */
    public function execute($request): void;

}
