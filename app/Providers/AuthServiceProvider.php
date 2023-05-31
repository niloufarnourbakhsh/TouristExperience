<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

       Gate::define('Is_admin',fn(User $user)=>$user->IsAdmin());

       Gate::define('manage_comment',fn (User $user,Comment $comment)=> $user->id===$comment->user_id || $user->IsAdmin());
    }
}
