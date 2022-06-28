<?php

namespace App\Tasks\Category;

use App\Repositories\CategoryRepositoryInterface;

class FindOrFailTask{

    private CategoryRepositoryInterface $category_repository;

    public function __construct(CategoryRepositoryInterface $category_repository){
        $this->category_repository = $category_repository;
    }

    public function run(string $id){
        return $this->category_repository->findOrFail($id);
    }

}
