<?php

namespace App\Actions\BusinessContact;

use App\Contracts\ContactInformation;
use Illuminate\Support\Facades\Auth;
use App\Dto\BusinessContact\CreateDto;
use App\Tasks;

class CreateAction implements ContactInformation{

    /**
     * @param CreateDto $dto
     * @return void
     */
    public function execute(CreateDto $dto): void
    {

        app(Tasks\BusinessInformation\CreateTask::class)->run(
            $dto->toArray() + ['business_id' => $this->getBusinessId()->id]
        );

    }

    public function getBusinessId(){
        return app(Tasks\Business\FindTask::class)->run(
            Auth::user()->id
        );
    }
}
