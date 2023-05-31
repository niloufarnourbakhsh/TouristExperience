<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MessagesController extends Controller
{
    public function index():view
    {
        $messages = Message::query()->paginate(8);
        return view('Admin.messages')->with('messages', $messages);
    }

    public function create():view
    {
        return view('user.contact');
    }

    public function store(MessageRequest $request)
    {
        Message::create($request->validated());
        Session::flash('messages', 'پیام شما ثبت شد');
        return back();
    }

    public function delete(Message $message)
    {
        $message->delete();
        return back();
    }
}
