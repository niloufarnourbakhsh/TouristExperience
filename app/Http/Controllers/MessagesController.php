<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function create()
    {

        return view('user.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'body' => 'required',
        ],[
            'name.required'=> 'لطفا نام خود را وارد کنید',
            'email.required'=> 'لطفا ایمیل خود را وارد کنید',
            'body.required'=> 'لطفا پیام خود را وارد کنید'
        ]);

        Message::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'body'=>$request->body
        ]);

        session()->flash('messages','پیام شما ثبت شد');
        return redirect()->back();
    }
}
