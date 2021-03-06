<?php

namespace App\Dto\BusinessContact;

use App\Http\Requests\BusinessContacts\CreateRequest;

class CreateDtoFactory{

    public static function fromRequest(CreateRequest $request){
        return self::fromArray($request->validated());
    }

    public static function fromArray(array $data): CreateDto
    {
        return new CreateDto([
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'site_location' => $data['site_location']
        ]);
    }

}
