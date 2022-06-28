<?php

namespace App\Tasks\User;

use App\Models\Image;

class UploadAvatarTask{

    public function run($user, $image): void
    {
        if ( $image ){
            $newImageName = uniqid() . '-image' . '.' . $image->extension();
            $image->move(public_path('images'), $newImageName);
            Image::updateOrCreate(
                [
                    'imageable_id' => $user->id,
                ],
                [
                'imageable_type' => 'App\Models\User',
                'filename' => $newImageName
                ]
            );
        }
    }
}
