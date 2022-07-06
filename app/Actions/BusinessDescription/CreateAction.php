<?php

namespace App\Actions\BusinessDescription;

use App\Contracts\BusinessDescription;
use App\Dto\BusinessDescription\CreateDto;
use App\Tasks;
use Illuminate\Support\Facades\Auth;
use App\Helpers;

class CreateAction implements BusinessDescription
{

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

        app(Tasks\BusinessDescription\CreateTask::class)->run(
            $dto->toArray() + ['business_id' => $this->user]
        );
    }

    public function delete($business_id): void{
        app(Tasks\BusinessDescription\DeleteTask::class)->run($business_id);
    }

}
