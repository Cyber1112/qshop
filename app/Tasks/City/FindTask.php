<?php

namespace App\Tasks\City;


use App\Repositories\CityRepositoryInterface;

class FindTask{

    private CityRepositoryInterface $city_repository;

    public function __construct(CityRepositoryInterface $city_repository){
        $this->city_repository = $city_repository;
    }

    public function run(string $id){
        return $this->city_repository->find($id);
    }

}
