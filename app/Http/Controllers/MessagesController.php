<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function create()
    {

        return view('user.contact');
    }

    public function store(MessageRequest $request)
    {

        Message::create($request->validated());
        session()->flash('messages','پیام شما ثبت شد');
        return redirect()->back();
    }
}
