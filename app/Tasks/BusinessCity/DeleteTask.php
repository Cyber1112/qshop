<?php

namespace App\Tasks\BusinessCity;

use App\Repositories\BusinessCityRepositoryInterface;

class DeleteTask{

    private BusinessCityRepositoryInterface $city_repository;

    public function __construct(BusinessCityRepositoryInterface $city_repository){

        $this->city_repository = $city_repository;
    }

    public function run($id){
        $this->city_repository->deleteByBusinessId($id);
    }

}
