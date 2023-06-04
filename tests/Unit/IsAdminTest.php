<?php

namespace Tests\Unit;

use App\Http\Middleware\IsAdmin;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IsAdminTest extends TestCase
{
    Use RefreshDatabase;
    /** @test */
    public function an_admin_role_send_to_ISAdmin_method()
    {
//        to dar to factory
        $user=User::factory(Role::create(['name'=>'Admin']))->create(['role_id'=>1]);
        $this->assertTrue($user->IsAdmin());

    }

    /** @test */
    public function an_user_role_send_to_ISAdmin_method()
    {
//        to dar to factory
        $user=User::factory(Role::create(['name'=>'User']))->create(['role_id'=>1]);
        $this->assertFalse($user->IsAdmin());
    }
}
