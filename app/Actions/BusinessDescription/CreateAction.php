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
    public function execute(CreateDto $dto, $business_id): void
    {
        $this->delete($business_id);

        app(Tasks\BusinessDescription\CreateTask::class)->run(
            $dto->toArray() + ['business_id' => $business_id]
        );
    }

    public function delete($business_id): void{
        app(Tasks\BusinessDescription\DeleteTask::class)->run($business_id);
    }

}
