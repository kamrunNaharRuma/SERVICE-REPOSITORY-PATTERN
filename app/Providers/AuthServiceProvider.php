<?php

namespace App\Providers;

use App\Constants\UserTypeConstant;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('store-update-delete-category', function (User $user) {
            return $user->user_type_id === UserTypeConstant::USER_TYPE_ID_FOR_ADMINS;
        });
        Gate::define('store-update-delete-product', function (User $user) {
            return $user->user_type_id === UserTypeConstant::USER_TYPE_ID_FOR_ADMINS;
        });
        //
    }
}
