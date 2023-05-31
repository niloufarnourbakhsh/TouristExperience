@extends('includes.admin-base')
@section('title','اعضای وبسایت')
@section('context')

    <div @class(['d-flex','flex-column','pt-3'])>

        <div @class(['d-flex','flex-row'])>
            <div>
                <h5> کاربرها </h5>
            </div>
            <div>
                @if(Session::has('users-delete'))
                    <p @class(['session' ,'text-white' ,'rounded' ,'p-2'])>
                        {{Session('users-delete')}}
                    </p>
                @endif
            </div>
        </div>

        <div @class(['p-3'])>
            <table @class(['table','rounded','bg-blue','text-white','t-font']) style="width: 60vw">
                <thead>
                <tr @class('text-right')>
                    <th>کد</th>
                    <th>نام کاربری</th>
                    <th>ایمیل</th>
                    <th>حذف</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr @class('text-right')>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <form method="post" action="{{route('delete.user',[$user->id])}}">
                                @csrf
                                <input type="hidden" value="DELETE" name="_method">
                                <button type="submit" @class(['btn','btn-delete','text-white','btn-sm'])>
                                    <i @class(['fas','fa-trash-alt'])></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div @class(['justify-content-center','align-self-center'])>

            <div @class(['text-center','mb-3'])>
                {{$users->links()}}
            </div>
        </div>

    </div>

@endsection
