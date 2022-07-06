<?php

namespace App\Actions\BusinessBonus;

use App\Contracts\BusinessBonus;
use App\Dto\BusinessBonus\CreateDto;
use App\Tasks;
use App\Helpers;
use Illuminate\Support\Facades\Auth;

class CreateAction implements BusinessBonus{

    protected $user;

    public function __construct()
    {
        $this->user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(CreateDto $dto): void
    {
        $this->delete($this->user);

        app(Tasks\BusinessBonusOption\CreateTask::class)->run(
            $dto->toArray() + ['business_id' => $this->user]
        );

    }
    public function delete($business_id){
        app(Tasks\BusinessBonusOption\DeleteTask::class)->run($business_id);
    }
}
