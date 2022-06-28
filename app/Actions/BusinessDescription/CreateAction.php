<?php

namespace App\Actions\BusinessDescription;

use App\Contracts\BusinessDescription;
use App\Dto\BusinessDescription\CreateDto;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class CreateAction implements BusinessDescription
{

    /**
     * @param CreateDto $dto
     * @return void
     */
    public function execute(CreateDto $dto): void
    {
        app(Tasks\BusinessDescription\CreateTask::class)->run(
            $dto->toArray() + ['business_id' => $this->getBusinessId()->id]
        );
    }

    public function getBusinessId(){
        return app(Tasks\Business\FindTask::class)->run(
            Auth::user()->id
        );
    }
}
