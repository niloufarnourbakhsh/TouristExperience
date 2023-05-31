@extends('includes.admin-base')
@section('title',' مدیریت')
@section('context')

    <div @class(['container','d-flex','flex-column','float-right','pt-4','align-items-baseline','justify-content-end'])>
        <div @class(['d-flex','flex-row','justify-content-between'])>
            <h5> پست ها </h5>
            <div>
                @if(\Illuminate\Support\Facades\Session::has('delete'))
                    <p @class(['session','text-white','p-2' ,'rounded'])> {{Session('delete')}}</p>

                @endif
            </div>
        </div>
        <div @class(['rounded','align-self-center'])>
            <table @class(['table','rounded','bg-blue','text-white','t-font']) style="width: 60vw">
                <thead>
                <tr @class('text-right')>
                    <th>کد</th>
                    <th>شهر</th>
                    <th>متن</th>
                    <th>فعال/غیرفعال</th>
                    <th>مشاهده</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                    <th colspan="2">تاریخ</th>
                </tr>

                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr @class('text-right')>
                        <td>{{$post->id}}</td>
                        <td>{{$post->city->name}}</td>
                        <td @class(['text-white'])>  {!! \Illuminate\Support\Str::limit($post->body , 115) !!}</td>

                        <td>
                            @if($post->is_active===1)
                                <form action="{{route('approval',[$post->id])}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT"/>
                                    <input type="hidden" name="status" value="{{0}}">
                                    <button @class(['btn','text-white','btn-approve','btn-sm']) type="submit">غیرفعال
                                    </button>
                                </form>
                            @else
                                <form action="{{route('approval',[$post->id])}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT"/>
                                    <input type="hidden" name="status" value="{{1}}">
                                    <button @class(['btn','text-white','btn-approve','btn-sm']) type="submit">فعال
                                    </button>
                                </form>
                            @endif
                        </td>
                        <td><a href="{{route('show.post',[$post->slug])}}" @class(['btn','btn-show','text-white','btn-sm'])><i
                                    @class(['fas',' fa-eye'])></i></a></td>

                        <td>
                            <a href="{{route('post.edit',[$post->id])}}" @class(['btn','btn-edit','btn-sm'])><i @class(['fas','fa-edit'])></i></a>
                        </td>
                        <td>
                            <form method="post" action="{{route('post.delete',[$post->id])}}">
                                @csrf
                                <input type="hidden" value="DELETE" name="_method">
                                <button type="submit" @class(['btn','btn-delete','text-white','btn-sm'])>
                                    <i @class(['fas','fa-trash-alt'])></i>
                                </button>

                            </form>
                        </td>
                        <td>{{$post->created_at->diffForhumans()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


    </div>
    <div @class(['justify-content-center','align-self-center'])>

        <div @class(['text-center','mb-3'])>
            {{$posts->links()}}
        </div>
    </div>
@endsection
