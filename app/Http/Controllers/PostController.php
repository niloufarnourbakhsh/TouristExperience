<?php

namespace App\Http\Controllers;

use App\Events\PostCreate;
use App\Events\PostDelete;
use App\Events\PostEvent;
use App\Events\PostUpdate;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Models\City;
use App\Models\Like;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('city')->paginate(5);
        return view('Admin.index')->with('posts', $posts);
    }

    public function create()
    {
        return view('Admin.create');
    }

    public function store(CreatePostRequest $request)
    {
        //add city to city table
        $city = City::create([
            'name' => $request->city
        ]);

        //add new post
        $data = array_merge($request->only(['title', 'body', 'food', 'sightseeing']), [
            'city_id' => $city->id,
            'user_id' => Auth::id()
        ]);
        $post = Post::create($data);

//        this is an array of images
        $images = $request->file;

//        the event below is for adding images
        \event(new PostCreate($post, $images));
        Session::flash('Added', 'پست اضافه شد  !');
        return redirect('/admin');
    }

    public function show($slug)
    {

        //first find the post
        $post = Post::query()->with(['user', 'comments', 'likes', 'photos'])
            ->withCount('likes')
            ->where('slug', $slug)
            ->first();

        $post->increment('view');
        $user = Auth::check() ? Auth::id() : null;
        $liked = false;
        if (!is_null($user)) {
            if ($post->likes_count > 0) {
                $liked = $post->likes()->where(['user_id' => $user])->first();
            }
        }
        $IsLiked = $liked ? true : false;
        return view('user.show')->with('post', $post)->with('IsLiked', $IsLiked);
    }

    public function like(Post $post)
    {
        // this part is for knowing if the user liked the post or not
        //first check the user is login or not
        $user = Auth::id();
        $likesCount = \count($post->likes);
        //check how many like the post have. if it is 0 it can not go to foreach loop
        //so we put the if below
        if ($likesCount === 0) {
            $post->likes()->create(['user_id' => $user]);
        } else {
            //look in the table to know if user like the post Or not
            $post->likes()->where(['user_id' => $user])->first() ?
                $post->likes()->where(['user_id' => $user])->delete() :
                $post->likes()->create(['user_id' => $user]);
        }
        return redirect()->back();
    }

    public function gallery()
    {
        $posts = Post::query()->with('photos')->where('is_active', true)->paginate(8);
        return view('user.gallery')->with('posts', $posts);
    }

    public function edit(Post $post)
    {
        $post->with('photos');
        return view('Admin.edit')->with('post', $post);
    }

    public function update(EditPostRequest $request, Post $post)
    {
        City::whereId($request->cityId)->update(['name' => $request->city]);
        $post->update($request->only(['title', 'body', 'food', 'sightseeing']));
        $images = $request->file;
//        add images to photo is in event below
        \event(new PostUpdate($post, $images));
        $post->save();
        return redirect()->back();
    }

    public function delete(Post $post)
    {
        if ($post->photos) {
            \event(new PostDelete($post));
        }
        $post->city()->delete();
        $post->delete();
        Session::flash('delete', 'پست مورد نظر حذف شد');
        return redirect()->back();
    }

    public function approve(Request $request, Post $post)
    {
        $post->update(['is_active' => $request->status]);
        return redirect()->back();
    }
}
