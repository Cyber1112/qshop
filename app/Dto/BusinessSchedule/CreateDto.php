<?php

namespace App\Dto\BusinessSchedule;

use Spatie\DataTransferObject\DataTransferObject;


class CreateDto extends DataTransferObject{
    public string $working_day;
    public string $work_time;
    public string $work_end;
}
