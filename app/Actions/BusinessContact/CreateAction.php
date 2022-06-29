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
    public function execute(CreateDto $dto, int $business_id): void
    {
        $this->delete($business_id);

        app(Tasks\BusinessInformation\CreateTask::class)->run(
            $dto->toArray() + ['business_id' => $business_id]
        );

    }

    public function delete($business_id): void{
        app(Tasks\BusinessInformation\DeleteTask::class)->run($business_id);
    }
}
