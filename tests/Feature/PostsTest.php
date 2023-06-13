<?php

namespace Tests\Feature;

use App\Models\Post;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
        $role=Role::create(['name' =>'Admin']);
        $this->admin=User::factory($role)->create(['role_id'=>$role->id]);
    }
    /** @test */
    public function show_posts_in_index_page()
    {
        $post=Post::factory()->create();
        $response=$this->actingAs($this->admin)->get('/admin');
        $response->assertSee($post->city->name);
    }

    /** @test */
    public function title_is_required()
    {
        $response=$this->actingAs($this->admin)->post('/posts',array_merge($this->data(),['title'=>'']));
        $response->assertSessionHasErrors('title');

    }

    /** @test */
    public function body_is_required()
    {
        $response = $this->actingAs($this->admin)->post('/posts',array_merge($this->data(),['body'=>'']));
        $response->assertSessionHasErrors('body');

    }

    /** @test */
    public function title_min_character()
    {
        $response=$this->actingAs($this->admin)->post('/posts',array_merge($this->data(),['title'=>'hii']));;
        $response->assertSessionHasErrors('title');
    }
    /** @test */
    public function city_is_required()
    {
        $response=$this->actingAs($this->admin)->post('/posts',array_merge($this->data(),['city'=>'']));
        $response->assertSessionHasErrors('city');

    }

    /**
     * @return array
     */
    protected function data(): array
    {
        return [
            'user_id' => $this->admin->id,
            'title' => 'testing',
            'slug' => Str::slug('test'),
            'body' => 'hello EveryOne',
            'food' => 'pizza',
            'sightseeing' => 'pole sefid',
            'view' => 0,
            'file'=>'chat.jpg',
            'city'=>'ahvaz'
        ];
    }
}
