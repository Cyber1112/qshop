<?php

namespace App\Dto\BusinessBonus;

use Spatie\DataTransferObject\DataTransferObject;

class CreateDto extends DataTransferObject{
    public int $bonus_amount;
    public int $activation_bonus_period;
    public int|null $deactivation_bonus_period;

}
