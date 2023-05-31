@extends('includes.public-nav')
@section('title','تماس با ما')
@section('image-part')
    <img src="{{url('img/tehran.png')}}" alt="" @class(['rounded-circle','image-style'])>
@endsection

@section('main-part')
    <div>
        @if(\Illuminate\Support\Facades\Session::has('messages'))
            <p @class(['text-white' ,'p-2' ,'rounded','text-right' ,'bg-success' ])>
                {{Session('messages')}}
            </p>
        @endif
        <h4 @class(['text-center'])> تماس با ما</h4>
        <div @class(['hr','m-auto','bg-magenta']) ></div>
        <div @class(['container', 'mt-4', 'mb-3', 'text-right'])>
            <form action="{{route('message.create')}}" method="POST">
                @csrf
                <div @class(['form-group'])>
                    <label for="name"> نام شما:</label>
                    <input type="text" name="name" @class(['form-control','my-input-style']) id="name">
                    @if($errors->first('name'))
                        <p @class(['text-danger','text-bold'])>{{$errors->first('name')}}</p>
                    @endif
                </div>
                <div @class(['form-group'])>
                    <label for="email"> ایمیل شما: </label>
                    <input type="email" name="email" id="email" @class(['form-control','my-input-style'])>
                    @if($errors->first('email'))
                        <p @class(['text-danger','text-bold'])>{{$errors->first('email')}}</p>
                    @endif
                </div>
                <div @class(['form-group'])>
                    <label for="body">پیام شما</label>
                    <textarea @class(['my-input-style','form-control']) name="body" id="body"></textarea>
                    @if($errors->first('body'))
                        <p @class(['text-danger','text-bold'])>{{$errors->first('body')}}</p>
                    @endif
                </div>

                <button @class(['btn','btn-block','btn-colorful','text-white']) type="submit">ارسال پیام</button>
            </form>
        </div>
    </div>


@endsection
