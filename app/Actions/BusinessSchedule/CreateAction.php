<?php

namespace App\Actions\BusinessSchedule;

use App\Contracts\BusinessSchedule;
use App\Tasks;
use Illuminate\Support\Facades\Auth;
use App\Helpers;

class CreateAction implements BusinessSchedule{

    protected $user;

    public function __construct()
    {
        $this->user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute($request): void
    {
        $this->delete($this->user);

        $counter = 0;

        foreach ($request->get('schedules') as $req){
            $data[] = $req;
            app(Tasks\BusinessSchedule\CreateTask::class)->run(
                [
                    'working_day' => $data[$counter]["working_day"],
                    'work_start' => $data[$counter]["work_start"],
                    'work_end' => $data[$counter]["work_end"],
                    "business_id" => $this->user
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
