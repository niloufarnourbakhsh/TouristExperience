<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    private $admin;

    public function setUp():void
    {
        parent::setUp();
        $role=Role::create(['name' => 'Admin']);
        $this->admin=User::factory()->create(['role_id'=>$role->id]);
    }
    /** @test */
    public function user_id_is_in_view()
    {
        $user=User::factory()->create();
        $this->actingAs($this->admin)->get('/users')
            ->assertSee('id',$user->id);

    }
    /** @test */
    public function user_name_is_in_view()
    {
        $user=User::factory()->create();
        $this->actingAs($this->admin)->get('/users')
            ->assertSee($user->name);

    }

    /** @test */
    public function user_email_is_in_view()
    {
        $user=User::factory()->create();
        $this->actingAs($this->admin)->get('/users')
            ->assertSee($user->email);

    }
    /** @test */
    public function just_admin_can_see_the_users()
    {
        User::factory()->create();
        $response=$this->actingAs($this->admin)->get('/users');

        $response->assertStatus(200);
    }
    /** @test */
    public function un_auth_user_can_not_see_the_users()
    {
        $role=Role::create(['name'=>'User']);
        $response=$this->get('/users');
        $response->assertStatus(302);
    }
    /** @test */
    public function do_not_show_admin_in_user_list()
    {
     $response=$this->get('users');
     $response->assertDontSee($this->admin->role_id)
;    }
    /** @test */
    public function admin_can_delete_a_user()
    {
        $user=User::factory()->create();
        $this->assertCount(2,User::all());
        $response=$this->actingAs($this->admin)->delete('/users/'.$user->id);
        $response->assertSessionHas('users-delete');
        $this->assertCount(1,User::all());
        $response->assertRedirect('/users');
    }

}
