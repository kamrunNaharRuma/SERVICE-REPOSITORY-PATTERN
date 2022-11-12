<?php

namespace App\UtilityClasses;

use App\Constants\UserTypeConstant;
use App\Models\User;
use App\Notifications\NewProductStored;
use Illuminate\Support\Facades\Notification;

class NotifyUser
{

    public function notifyUserForNewProduct($product)
    {
        $users = User::where('user_type_id', UserTypeConstant::USER_TYPE_ID_FOR_USERS)->get();
        foreach ($users as $user) {
            Notification::send($user, new NewProductStored($product));
        }
    }
}
