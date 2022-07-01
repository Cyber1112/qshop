<?php

namespace App\Dto\BusinessTransaction;

use Spatie\DataTransferObject\DataTransferObject;

class CreateDto extends DataTransferObject {
    public string $phone_number;
    public int $bonus_amount;
    public int $purchase_amount;
    public string|null $comment;
}

