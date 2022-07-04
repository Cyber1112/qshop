<?php

namespace App\Providers;

use App\Actions as Actions;
use App\Contracts as Contracts;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    public array $singletons = [
        Contracts\Login::class => Actions\Login\LoginAction::class,
        Contracts\Logout::class => Actions\LogoutAction::class,

        Contracts\UserAccount::class => Actions\UserAccount\CreateAction::class,

//        BUSINESSES
        Contracts\ContactInformation::class => Actions\BusinessContact\CreateAction::class,
        Contracts\BusinessDescription::class => Actions\BusinessDescription\CreateAction::class,
        Contracts\BusinessCity::class => Actions\BusinessCity\CreateAction::class,
        Contracts\BusinessCategory::class => Actions\BusinessCategory\CreateAction::class,
        Contracts\BusinessSchedule::class => Actions\BusinessSchedule\CreateAction::class,
        Contracts\GetAllCities::class => Actions\City\GetAllAction::class,
        Contracts\BusinessBonus::class => Actions\BusinessBonus\CreateAction::class,

//        TRANSACTION
        Contracts\Transaction::class => Actions\BusinessTransactionHistory\CreateAction::class,
        Contracts\TransactionComments::class => Actions\BusinessTransactionHistoryComments\CreateAction::class,
        Contracts\WriteOffBonusFromClient::class => Actions\BusinessTransactionHistory\WriteOffAction::class,
        Contracts\BusinessClientBonus::class => Actions\BusinessClientBonus\GetBusinessClientAction::class,
        Contracts\GetBusinessClientBonus::class => Actions\BusinessClientBonus\GetBusinessClientAction::class,

//        EMPLOYEES
        Contracts\AddEmployee::class => Actions\Employee\CreateAction::class,
        Contracts\DeleteEmployee::class => Actions\Employee\DeleteAction::class,

    ];
}
