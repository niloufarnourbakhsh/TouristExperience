<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    //

    public function index()
    {
        $comments=Comment::with('post')->paginate(8);
        return view('Admin.message')->with('comments',$comments);
    }


    public function create(MessageRequest $request)
    {

        Auth::user()->comments()->create(['post_id'=>$request->post_id,'body'=>$request->body]);
        return redirect()->back();
    }

    public function delete($id){

        Comment::find($id)->delete();
        Session::flash('delete_message','پیام موورد نظر حذف شد');
        return redirect()->back();
    }

}
