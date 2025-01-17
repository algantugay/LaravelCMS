<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Carbon::setLocale('tr');

        $this->createDefaultRolesAndAdmin();
    }

    protected function createDefaultRolesAndAdmin(): void
    {
        if (Role::count() === 0) {
            Role::insert([
                ['id' => 1, 'role' => 'user', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 2, 'role' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role_id' => 2,
                'avatar' => null,
                'last_login' => null,
            ]);
        }
    }

    protected $listen = [
        \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\UpdateLastLogin::class,
        ],
    ];
    
}
