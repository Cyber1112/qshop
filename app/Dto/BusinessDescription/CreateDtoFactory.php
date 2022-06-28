<?php

namespace App\Dto\BusinessDescription;

use App\Http\Requests\BusinessDescription\CreateRequest;

class CreateDtoFactory{

    public static function fromRequest(CreateRequest $request){
        return self::fromArray($request->validated());
    }

    public static function fromArray(array $data): CreateDto
    {
        return new CreateDto([
            'description' => $data['description'],
        ]);
    }

}
