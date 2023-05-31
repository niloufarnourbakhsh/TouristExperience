<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CommentController extends Controller
{

    public function index():view
    {
        $comments = Comment::with('post')->paginate(8);
        return view('Admin.comments')->with('comments', $comments);
    }

    public function create(CommentsRequest $request)
    {
        Auth::user()->comments()->create($request->validated());
        return back();
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
        Session::flash('delete_message', 'پیام موورد نظر حذف شد');
        return back();
    }

}
