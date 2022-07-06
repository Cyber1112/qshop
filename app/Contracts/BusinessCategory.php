<?php

namespace App\Contracts;

interface BusinessCategory{

    public function execute(array $categories): void;

}
