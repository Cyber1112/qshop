<?php

namespace App\Contracts;

interface BusinessSchedule{

    /**
     * @param $request
     * @return void
     */
    public function execute($request): void;

}
