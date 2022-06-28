<?php

namespace App\Actions\BusinessSchedule;

use App\Contracts\BusinessSchedule;
use App\Dto\BusinessSchedule\CreateDto;
use App\Models\Business;
use App\Models\User;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class CreateAction implements BusinessSchedule{

    public function execute($request): void
    {
        $this->delete();

        $counter = 0;

        foreach ($request->get('schedules') as $req){
            $data[] = $req;
            app(Tasks\BusinessSchedule\CreateTask::class)->run(
                [
                    'working_day' => $data[$counter]["working_day"],
                    'work_start' => $data[$counter]["work_start"],
                    'work_end' => $data[$counter]["work_end"],
                    "business_id" => $this->getBusinessId()->id
                ]
            );

            $counter += 1;
        }
    }

    public function getBusinessId(){
        return app(Tasks\Business\FindTask::class)->run(
            Auth::user()->id
        );
    }


    public function delete(): void
    {
        app(Tasks\BusinessSchedule\DeleteTask::class)->run(
            $this->getBusinessId()->id
        );
    }
}
