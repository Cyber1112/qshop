<?php

namespace App\Dto\BusinessContact;

use Spatie\DataTransferObject\DataTransferObject;


class CreateDto extends DataTransferObject{
    public string $address;
    public string $phone_number;
    public string $site_location;
}
