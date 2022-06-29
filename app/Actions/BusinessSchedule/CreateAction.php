<?php

namespace App\Actions\BusinessSchedule;

use App\Contracts\BusinessSchedule;
use App\Tasks;

class CreateAction implements BusinessSchedule{

    public function execute($request, int $business_id): void
    {
        $this->delete($business_id);

        $counter = 0;

        foreach ($request->get('schedules') as $req){
            $data[] = $req;
            app(Tasks\BusinessSchedule\CreateTask::class)->run(
                [
                    'working_day' => $data[$counter]["working_day"],
                    'work_start' => $data[$counter]["work_start"],
                    'work_end' => $data[$counter]["work_end"],
                    "business_id" => $business_id
                ]
            );

            $counter += 1;
        }
    }

    public function delete($business_id): void
    {
        app(Tasks\BusinessSchedule\DeleteTask::class)->run(
            $business_id
        );
    }
}
