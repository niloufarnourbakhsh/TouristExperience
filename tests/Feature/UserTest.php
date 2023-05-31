<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /** @test */
    public function user_id_is_in_view()
    {
        $user=User::factory()->create();
        $admin=User::factory()->create(['role_id'=>1]);
        $this->actingAs($admin)->get('/users')
            ->assertSee('id',$user->id);

    }
    /** @test */
    public function user_name_is_in_view()
    {
        $user=User::factory()->create();
        $admin=User::factory()->create(['role_id'=>1]);
        $this->actingAs($admin)->get('/users')
            ->assertSee('name',$user->name);

    }

    /** @test */
    public function user_email_is_in_view()
    {
        $user=User::factory()->create();
        $admin= $this->admin();
        $this->actingAs($admin)->get('/users')
            ->assertSee('email',$user->email);

    }
    /** @test */
    public function just_admin_can_see_the_users()
    {
        $this->withExceptionHandling();
        $role=Role::create(['name'=>'Admin']);
        User::factory()->create();
        $admin=User::factory()->create(['role_id'=>$role->id]);
        $response=$this->actingAs($admin)->get('/users');

        $response->assertStatus(200);
    }
    /** @test */
    public function un_auth_user_can_not_see_the_users()
    {
        $role=Role::create(['name'=>'User']);
        $this->withExceptionHandling();
        $user=User::factory()->create(['role_id'=>$role->id]);
        $response=$this->actingAs($user)->get('/users');
        $response->assertStatus(302);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function admin(): \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
    {
        return User::factory()->create(['role_id' => 1]);
    }
}
