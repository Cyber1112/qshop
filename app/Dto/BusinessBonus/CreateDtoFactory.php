<?php

namespace App\Dto\BusinessBonus;

use App\Http\Requests\BusinessBonus\CreateRequest;

class CreateDtoFactory{

    public static function fromRequest(CreateRequest $request){
        return self::fromArray($request->validated());
    }

    public static function fromArray(array $data): CreateDto
    {
        return new CreateDto([
            'bonus_amount' => $data['bonus_amount'],
            'activation_bonus_period' => $data['activation_bonus_period'] ?? 0,
            'deactivation_bonus_period' => $data['deactivation_bonus_period'] ?? null
        ]);
    }

}
