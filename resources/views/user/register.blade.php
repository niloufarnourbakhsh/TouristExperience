@extends('includes.public-nav')
@section('title','عضویت')
@section('image-part')
    <img src="{{url('img/tabiat-bridge4.jpg')}}" alt=""  @class(['rounded-circle','image-style'])>
@endsection

@section('main-part')

    <div>
        <h4 @class(['text-center ','pb-3','mt-3']) >عضویت در سامانه</h4>
        <div @class(['hr','m-auto','bg-magenta'])></div>
        <div @class(['container','mt-4','text-right'])>
            <form action="{{route('register')}}" method="POST">
                @csrf
                <div  @class(['form-group'])>
                    <label for="name">نام کاربری:</label>
                    <input type="text" id="name" name="name" @class(['my-input-style','form-control'])>
                    @if($errors->first('name'))
                        <p @class(['text-danger'])>
                            {{$errors->first('name')}}
                        </p>
                    @endif
                </div>
                <div  @class(['form-group'])>
                    <label for="email">پست الکترونیکی:</label>
                    <input type="text" id="email" name="email" @class(['my-input-style','form-control'])>
                    @if($errors->first('email'))
                        <p @class(['text-danger'])>
                            {{$errors->first('email')}}
                        </p>
                    @endif
                </div>
                <div  @class(['form-group'])>
                    <label for="password"> رمز عبور:</label>
                    <input type="password" name="password" id="password" @class(['my-input-style','form-control'])>
                    @if($errors->first('password'))
                        <p @class(['text-danger']) >
                            {{$errors->first('password')}}
                        </p>
                    @endif
                </div>
                <div  @class(['form-group'])>
                    <label for="re-password">تکرار رمز عبور:</label>
                    <input type="password" name="password_confirmation" id="re-password" @class(['my-input-style','form-control']) >
                    @if($errors->first('password_confirmation'))
                        <p @class(['text-danger'])>
                            {{$errors->first('password_confirmation')}}
                        </p>
                    @endif
                </div>
                <button  @class(['btn','btn-colorful','btn-block','text-white',' text-center']) type="submit" name="register">عضویت</button>
            </form>

        </div>
    </div>

@endsection
