@extends('includes.public-nav')
@section('title',$post->title)
@section('image-part')
    <div class="container">
        <div class="m-auto text-center">
            <img src="{{url('storage/'.$post->photos->first()->file)}}" alt="" @class(['rounded','first-image'])
            id="BigImage">
        </div>
        <div @class(['row','row-cols-3','float-left','mb-3'])>
            @foreach($post->photos as $photo)
                <div @class(['col','mt-2',' mb-2'])>
                    <div @class(['card','toChoose'])>
                        <img src="{{url('storage/'.$photo->file)}}" alt=""
                            @class(['rounded','show-image-size','card-img-top'])>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('main-part')
    <div @class(['text-right','p-3'])>
        <div @class(['p-title','text-bold','mt-4'])>
            <p>{{$post->title}}</p>
        </div>
        <div @class(['p-body',' p-2','bg-gray','mt-4'])>
            <p>{!! $post->body !!} </p>
        </div>
        @if($post->food)
            <div @class(['p-title','text-bold','mt-4'])>
                <p>
                    غذاهای سنتی
                </p>
            </div>
            <div @class(['p-body','p-2','bg-gray','mt-4'])>
                <p>{{$post->food}} </p>
            </div>
        @endif
        @if($post->sightseeing)
            <div @class(['p-title','text-bold','mt-4'])>
                <p>
                    مکانهای دیدنی
                </p>
            </div>
            <div @class(['p-body','p-2','bg-gray','mt-4'])>
                <p>{{$post->sightseeing}}</p>
            </div>
        @endif
    </div>

    <div @class(['clr'])></div>
    <section id="comment">
        <div @class(['container'])>
            <div @class(['text-right','p-3 ','pr-5'])>
                <div @class(['mt-4','text-right','h6',' top-border-blue'])>
                    <i @class(['far','fa-eye','bg-blue','text-white','p-3',' pr-4','pl-4',' ml-2'])></i>
                    تعداد بازدید ها
                    <span @class(['bg-blue','p-2','rounded-circle','text-left','text-white','mr-3'])>{{$post->view}}</span>
                </div>
                <p @class(['h6','mt-4','text-right','top-border-purple'])>
                    <i @class(['fa','fa-comments','fa-2x','i-color','text-white','p-2','pr-4','pl-4','ml-2'])></i>
                    ارسال نظر
                </p>
                <form action="{{route('comment.create')}}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->id}}"/>
                    @auth
                        <label for="body"></label>
                        <textarea @class(['form-control','my-input-style']) name="body" id="body"></textarea>
                        @if($errors->first('body'))
                            <p @class(['text-danger'])>
                                {{$errors->first('body')}}
                            </p>
                        @endif

                    @else
                        <p @class(['text-right','mt-3'])>
                            ارسال نظر فقط برای اعضای پیج امکان پذیر است
                        </p>
                        <label for="no-body"></label>
                        <textarea @class(['form-control','bg-gray']) id="no-body" disabled></textarea>
                    @endauth
                    <button
                        @class(['btn','btn-block',' btn-colorful','text-white','text-center','mt-3'])  type="submit">
                        ارسال نظر
                    </button>
                </form>
            </div>
            <div @class(['clr'])></div>
        </div>
    </section>
    <section id="show-comment" @class(['container','m-3' ,'mt-5'])>
        <div @class(['row','top-border-purple'])>
            <p @class(['text-center','col-2','text-bold',' mt-4','bg-purple','text-white','p-2'])> نظرات</p>
            <p @class(['col-8'])></p>
            <div @class(['text-center','col-2 ','mt-4',' text-bold'])>
                @if(Auth::check())
                    <form action="{{ route('like',[$post->id])}}" method="post">
                        @csrf
                        @if($IsLiked)
                            <button @class(['btn'])><span><i @class(['fas','fa-heart','fa-2x'])></i></span></button>
                        @else
                            <button @class(['btn'])><span><i @class(['far','fa-heart','fa-2x'])></i></span></button>
                        @endif
                    </form>
                @else
                    <button @class(['btn','disabled']) disabled="disabled">
                        <span><i @class(['far','fa-heart','fa-2x'])></i></span>
                    </button>
                @endif
                <p @class(['text-muted'])> {{$post->likes_count}}</p>
            </div>
        </div>
        @foreach($post->comments as $comment)
            <div @class(['comments','d-flex',' flex-column','text-right','m-3','bg-gray',' rounded','p-2'])>
                <div @class(['d-flex','justify-content-between']) >
                    <p>{{$comment->user->name}}</p>
                        @can('manage_comment',$comment)
                            <div>
                                <form action="{{route('comment.delete',[$comment->id])}}" method="post">
                                    @csrf
                                    <input type="hidden" value="DELETE" name="_method">
                                    <button @class(['btn','bg-gray','text-purple'])type="submit"><i
                                            @class(['far','fa-times-circle'])></i></button>
                                </form>
                            </div>
                    @endcan
                </div>
                <p>{{$comment->body}}</p>
            </div>
        @endforeach

    </section>
@endsection

@section('extra-js')
    <script>
        (function () {
            const BigImage = document.querySelector('#BigImage');
            let images = document.querySelectorAll('.toChoose');
            images.forEach((image) => image.addEventListener('click', function () {
                BigImage.src = this.querySelector('img').src;
            }));

        })();

    </script>
@endsection
