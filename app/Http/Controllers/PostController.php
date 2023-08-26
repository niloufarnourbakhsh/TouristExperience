<?php

namespace App\Http\Controllers;

use App\Events\PostCreate;
use App\Events\PostDelete;
use App\Events\PostUpdate;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Models\City;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


class PostController extends Controller
{
    public function index():view
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

        $data = array_merge($request->only(['title', 'body', 'food', 'sightseeing']), [
            'city_id' =>  (City::create([
                'name' => $request->city
            ]))->id,
            'user_id' => Auth::id()
        ]);

        $post = Post::create($data);
        $images = $request->file;

        \event(new PostCreate($post, $images));
        Session::flash('Added', 'پست اضافه شد  !');
        return redirect('/admin');
    }

    public function show(Post $post):view
    {
//        first find the post
        $post->increment('view');
        $post->with(['user', 'comments', 'likes', 'photos']);
        $likes_count =$post->withCount('likes');

        $IsLiked = false;
        if (Auth::check()) {

            if ($likes_count > 0) {
                $IsLiked = $post->likes()->where(['user_id' => Auth::id()])->first()? true: false;
            }
        }

        return view('user.show')->with('post', $post)->with('IsLiked', $IsLiked);
    }

    public function like(Post $post)
    {
        $likesCount = \count($post->likes);
        if ($likesCount === 0) {
            $post->likes()->create(['user_id' => Auth::id()]);
        } else {
            //look in the table to know if user like the post Or not
            $post->likes()->where(['user_id' => Auth::id()])->first() ?
                $post->likes()->where(['user_id' => Auth::id()])->delete() :
                $post->likes()->create(['user_id' => Auth::id()]);
        }
        return back();
    }

    public function gallery():view
    {
        $posts = Post::query()->with('photos')->where('is_active', true)->paginate(8);
        return view('user.gallery')->with('posts', $posts);
    }

    public function edit(Post $post):view
    {
        $post->with(['photos','city']);
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
        return back();
    }

    public function delete(Post $post)
    {
        if ($post->photos) {
            \event(new PostDelete($post));
        }
        $post->city()->delete();
        $post->delete();
        Session::flash('delete', 'پست مورد نظر حذف شد');
        return back();
    }

    public function approve(Request $request, Post $post)
    {
        $post->update([
            'is_active'=>$request->status
        ]);
        return back();
    }
}
