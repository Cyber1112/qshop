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
        $this->delete();

        app(Tasks\BusinessSchedule\CreateTask::class)->run(
            [
                'work_schedule' => $request["work_schedule"],
                'work_start' => $request["work_start"],
                'work_end' => $request["work_end"],
                "business_id" => $this->user
            ]
        );

    }

    public function delete(): void
    {
        app(Tasks\BusinessSchedule\DeleteTask::class)->run(
            $this->user
        );
    }
}
