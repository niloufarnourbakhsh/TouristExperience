@extends('includes.admin-base')
@section('title','پیام های ارسالی')
@section('context')

    <div @class(['d-flex','flex-column','float-right','pt-4','align-items-baseline','justify-content-end'])>

        <div @class(['d-flex' ,'flex-row' ,'justify-content-between'])>
            <h5>پیام ها </h5>
            <div>
                @if(Session::has('delete_message'))
                    <p @class(['text-white','session','p-2','rounded'])>{{Session('delete_message')}}</p>
                @endif
            </div>
        </div>

        <div>
            <table @class(['table','rounded','bg-blue','text-white','t-font']) style="width: 60vw">
                <thead>
                <tr @class('text-right')>
                    <th>نام ارسال کننده</th>
                    <th> ایمیل</th>
                    <th>متن پیام</th>
                    <th>حذف</th>
                    <th colspan="2">تاریخ</th>
                </tr>

                </thead>
                <tbody>
                @foreach($messages as $message)
                    <tr @class('text-right')>

                        <td>{{$message->name}}</td>
                        <td>{{$message->email}}</td>
                        <td>{{$message->body}}</td>
                        <td>
                            <form method="post" action="{{route('message.delete',[$message->id])}}">
                                @csrf
                                <input type="hidden" value="DELETE" name="_method">
                                <button type="submit" @class(['btn','btn-delete','text-white','btn-sm'])>
                                    <i @class(['fas','fa-trash-alt'])></i>
                                </button>
                            </form>
                        </td>
                        <td>{{$message->created_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div @class(['justify-content-center','align-self-center','mb-3'])>
            <div @class(['text-center','mb-3','mt-2'])>
                {{$messages->links()}}
            </div>
        </div>


    </div>

@endsection
