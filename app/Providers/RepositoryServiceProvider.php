<?php

namespace App\Providers;

use App\Repositories as Repositories;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        Repositories\UserRepositoryInterface::class => Repositories\Eloquent\UserRepository::class,
//        Repositories\CreateEmployeeRepositoryInterface::class => Repositories\Eloquent\CreateEmployeeRepository::class,

//        BUSINESSES
        Repositories\BusinessRepositoryInterface::class => Repositories\Eloquent\BusinessRepository::class,
        Repositories\BusinessContactRepositoryInterface::class => Repositories\Eloquent\BusinessContactRepository::class,
        Repositories\BusinessDescriptionRepositoryInterface::class => Repositories\Eloquent\BusinessDescriptionRepository::class,
        Repositories\CityRepositoryInterface::class => Repositories\Eloquent\CityRepository::class,
        Repositories\BusinessCityRepositoryInterface::class => Repositories\Eloquent\BusinessCityRepository::class,
        Repositories\CategoryRepositoryInterface::class => Repositories\Eloquent\CategoryRepository::class,
        Repositories\BusinessCategoryRepositoryInterface::class => Repositories\Eloquent\BusinessCategoryRepository::class,
        Repositories\BusinessScheduleRepositoryInterface::class => Repositories\Eloquent\BusinessScheduleRepository::class,
        Repositories\BusinessBonusRepositoryInterface::class => Repositories\Eloquent\BusinessBonusRepository::class,

//        EMPLOYEES

        Repositories\EmployeeRepositoryInterface::class => Repositories\Eloquent\EmployeeRepository::class,

//        CLIENTS

        Repositories\ClientRepositoryInterface::class => Repositories\Eloquent\ClientRepository::class,

//      Transactions
        Repositories\TransactionHistoryRepositoryInterface::class => Repositories\Eloquent\TransactionHistoryRepository::class,
        Repositories\TransactionCommentsRepositoryInterface::class => Repositories\Eloquent\TransactionCommentsRepository::class,
    ];
}
