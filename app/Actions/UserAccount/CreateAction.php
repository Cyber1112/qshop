<?php

namespace App\Actions\UserAccount;

use App\Contracts\UserAccount;
use App\Models\Business;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class CreateAction implements UserAccount {

    public function execute($data): void
    {

        $this->updataName($data->name);

        if(Auth::user()->hasRole('business')){
            $this->updateBusinessName($data->business_name);
        }

        $this->updateAvatar($data->image);
    }

    public function updataName($name){
        app(Tasks\User\UpdateNameTask::class)->run(
            Auth::user(),
            ['name' => $name]
        );
    }

    public function updateBusinessName($business_name){
        app(Tasks\BusinessAccount\UpdateBusinessNameTask::class)->run(
            Business::find($this->getBusinessId()->id),
            ['business_name' => $business_name]
        );
    }

    public function updateAvatar($image){
        app(Tasks\User\UploadAvatarTask::class)->run(
            Auth::user(),
            $image
        );
    }

    public function getBusinessId(){
        return app(Tasks\Business\FindTask::class)->run(
            Auth::user()->id
        );
    }

}
