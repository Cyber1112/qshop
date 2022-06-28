<?php

namespace App\Dto\BusinessSchedule;

use App\Http\Requests\BusinessSchedule\CreateRequest;

class CreateDtoFactory{

    public static function fromRequest(CreateRequest $request){
        return self::fromArray($request->validated());
    }

    public static function fromArray(array $data): CreateDto
    {
        return new CreateDto([
            'working_day' => $data['working_day'],
            'work_start' => $data['work_start'],
            'work_end' => $data['work_end']
        ]);
    }

}
