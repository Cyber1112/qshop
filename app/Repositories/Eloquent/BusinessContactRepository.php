<?php

namespace App\Repositories\Eloquent;

use App\Models\Contact;
use App\Repositories\BusinessContactRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class  BusinessContactRepository extends BaseRepository implements BusinessContactRepositoryInterface {

    /**
     * @param Contact $model
     */
    public function __construct(Contact $model){
        $this->model = $model;
    }

}
