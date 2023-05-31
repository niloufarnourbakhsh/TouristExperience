<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],[
            'name.required'=>'لطفا نام کاربری را وارد کنید',
            'name.string'=>'نام کاربری معتبر نیست',
            'name.max'=>'حداکثر تعداد کارکتر مجاز 255 کارکتر است',
            'email.required'=>'لطفا ایمیل خود را وراد کنید',
            'email.string'=>'ایمیل معتبر نیست',
            'email.email'=>'یمیل معتبر نیست',
            'email.max'=>'حداکثر تعداد کارکتر مجاز 255 کارکتر است',
            'email.unique'=>'این ایمیل قبلا وارد شده است',
            'password.required'=>'لطفا رمز عبور را وارد کنید',
            'password.string'=>'پسورد شما باید شامل حروف هم باشد',
            'password.min'=>'حداقل تعداد کارکتر مجاز ۸ کارکتر است',
            'password.confirmed'=>'رمز عبور شما و تکرار آن متفاوت است',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
