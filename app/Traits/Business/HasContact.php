<?php

namespace App\Traits\Business;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasContact{

    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class);
    }

}
