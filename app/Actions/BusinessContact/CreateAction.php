<?php

namespace App\Actions\BusinessContact;

use App\Contracts\ContactInformation;
use Illuminate\Support\Facades\Auth;
use App\Dto\BusinessContact\CreateDto;
use App\Tasks;
use App\Helpers;

class CreateAction implements ContactInformation{

    protected $user;

    public function __construct()
    {
        $this->user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    /**
     * @param CreateDto $dto
     * @return void
     */
    public function execute(CreateDto $dto): void
    {
        $this->delete($this->user);

        app(Tasks\BusinessInformation\CreateTask::class)->run(
            $dto->toArray() + ['business_id' => $this->user]
        );

    }

    public function delete($business_id): void{
        app(Tasks\BusinessInformation\DeleteTask::class)->run($business_id);
    }
}
