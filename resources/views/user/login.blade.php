@extends('includes.public-nav')
@section('title','ورود')
@section('image-part')
    <img src="{{url('img/Azadi-Tower-Tehran.jpg')}}" alt="" @class(['rounded-circle','image-style'])>
@endsection

@section('main-part')
    <div>
        <h4 @class(['text-center ','pb-3','mt-3'])> ورود به سامانه</h4>
        <div @class(['hr','m-auto','bg-magenta'])></div>
        <div @class(['container','mt-4','mb-3','text-right'])>
            <form action="{{route('login')}}" method="POST">
                @csrf
                <div @class(['form-group'])>
                    <label for="username"> نام کاربری: </label>
                    <input type="text" name="name" @class(['form-control','my-input-style']) id="username">
                    @if($errors->first('name'))
                        <p @class(['text-danger'])>
                            {{$errors->first('name')}}
                        </p>
                    @endif
                </div>
                <div>
                    <label for="password"> رمز عبور:</label>
                    <input type="password" name="password" id="password" @class(['my-input-style','form-control'])>
                    @if($errors->first('password'))
                        <p @class(['text-danger'])>
                            {{$errors->first('password')}}
                        </p>
                    @endif
                </div>
                <button @class(['btn','btn-colorful','btn-block','text-white',' mt-4']) type="submit" name="login">ورود </button>
            </form>

        </div>
    </div>

@endsection
