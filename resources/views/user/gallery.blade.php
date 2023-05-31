@extends('includes.header')

@section('title',' گالری تصاویر')
<body>
<section id="showcase">
    <div @class(['cover'])>
        <div @class(['container'])>
        @include('includes.gallery-main-nav')
            <div @class(['content','d-flex', 'flex-column', 'align-items-center'])>
                <div @class(['container','p-2','mt-3','gallery'])>
                    <div @class(['p-3','rounded']) style="min-height: 85%">
                        <div @class(['row','row-cols-4'])>
                         @if($posts)
                            @foreach($posts as $post)

                            <div @class(['col','mb-3'])>
                                <a href="{{route('show.post',[$post->slug])}} ">
                                <div @class(['card','rounded'])>
                                        <img src="{{url('/storage/'.$post->photos->first()->file)}}" alt="" @class(['card-img-top','img-size'])>
                                        <p @class(['card-img-overlay','text-center','text-bold'])>
                                            <span @class(['text-white','p-2','rounded-circle','bg-blue'])>{{$post->title}}</span>
                                        </p>
                                </div>
                                </a>

                            </div>
                            @endforeach
                         @endif

                        </div>

                            <div class="container" >
                                <div @class(['row','mt-2'])>
                                    <div @class(['col-5'])></div>
                                    <div @class(['col-2'])>
                                        <div @class(['mb-2 ','text-center '])>
                                            {{$posts->links()}}
                                        </div>
                                    </div>
                                    <div @class(['col-5'])></div>
                                </div>

                        </div>

                    </div>

                    </div>
                </div>

            </div>

        </div>

</section>
