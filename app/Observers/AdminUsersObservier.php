<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class AdminUsersObservier
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    // public function deleted(User $user): void
    // {
    //     $profile_image = Str::after($user->profile_image, env('APP_URL'));
    //     $front = Str::after($user->id_photo_front, env('APP_URL'));
    //     $back = Str::after($user->id_photo_back, env('APP_URL'));
    //     $selfie = Str::after($user->selfie_with_id, env('APP_URL'));
    //     if (is_file(base_path() . $profile_image))
    //         unlink(base_path() . $profile_image);

    //     if (is_file(base_path() . $front))
    //         unlink(base_path() . $front);

    //     if (is_file(base_path() . $back))
    //         unlink(base_path() . $back);

    //     if (is_file(base_path() . $selfie))
    //         unlink(base_path() . $selfie);
    // }

    public function deleted(User $user): void
    {
        $profile_image = Str::after($user->profile_image, env('APP_URL'));
        $front = Str::after($user->id_photo_front, env('APP_URL'));
        $back = Str::after($user->id_photo_back, env('APP_URL'));
        $selfie = Str::after($user->selfie_with_id, env('APP_URL'));

        $files = [
            base_path() . $profile_image,
            base_path() . $front,
            base_path() . $back,
            base_path() . $selfie,
        ];

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }



    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
