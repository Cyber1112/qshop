<?php

namespace App\Tasks\City;

use App\Repositories\CityRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetAllTask
{
    private CityRepositoryInterface $city_repository;

    public function __construct(CityRepositoryInterface $city_repository)
    {
        $this->city_repository = $city_repository;
    }

    /**
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return Collection
     */
    public function run(array $columns = ['*'], array $relations = [], array $relations_count = []): Collection
    {
        return $this->city_repository->getAll($columns, $relations, $relations_count);
    }
}
