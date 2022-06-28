<?php

namespace App\Tasks\BusinessCity;


use App\Repositories\BusinessCityRepositoryInterface;

class CreateTask{


    private BusinessCityRepositoryInterface $city_repository;

    public function __construct(BusinessCityRepositoryInterface $city_repository){

        $this->city_repository = $city_repository;
    }

    public function run(array $payload){
        $this->city_repository->create($payload);
    }

}
