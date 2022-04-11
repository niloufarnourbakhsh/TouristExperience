<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::with('post')->paginate(8);
        return view('Admin.comments')->with('comments', $comments);
    }

    public function create(CommentsRequest $request)
    {
        Auth::user()->comments()->create($request->validated());
        return redirect()->back();
    }

    public function delete($id)
    {
        Comment::find($id)->delete();
        Session::flash('delete_message', 'پیام موورد نظر حذف شد');
        return redirect()->back();
    }

}
