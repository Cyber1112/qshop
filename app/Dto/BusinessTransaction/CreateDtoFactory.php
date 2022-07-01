<?php

namespace App\Dto\BusinessTransaction;

use App\Http\Requests\BusinessTransaction\CreateRequest;

class CreateDtoFactory{

    public static function fromRequest(CreateRequest $request){
        return self::fromArray($request->validated());
    }

    public static function fromArray(array $data): CreateDto
    {
        return new CreateDto([
            'phone_number' => $data['phone_number'],
            'bonus_amount' => $data['bonus_amount'],
            'purchase_amount' => $data['purchase_amount'],
            'comment' => $data['comment'] ?? null
        ]);
    }

}
