<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function index()
    {
        $users = User::where('role_id', 2)->paginate(8);
        return view('Admin.users')->with('users', $users);

    }

    public function delete(User $user)
    {
        $user->delete();
        Session::flash('users-delete', 'کاربر مورد نظر حذف شد');
        return redirect()->back();
    }

}
