<?php

namespace App\Actions\BusinessBonus;

use App\Contracts\BusinessBonus;
use App\Dto\BusinessBonus\CreateDto;
use App\Tasks;

class CreateAction implements BusinessBonus{

    public function execute(int $business_id, CreateDto $dto): void
    {
        $this->delete($business_id);

        app(Tasks\BusinessBonusOption\CreateTask::class)->run(
            $dto->toArray() + ['business_id' => $business_id]
        );

    }
    public function delete($business_id){
        app(Tasks\BusinessBonusOption\DeleteTask::class)->run($business_id);
    }
}
