@extends('includes.admin-base')

@section('context')
    <div class="container">
        <div class="row ">
            <div class="col-12 justify-content-end  align-self-end">

                <div class="row">
                    <div class="col-6">
                        <div class="d-flex flex-column align-self-end mb-4">
                            <div class="d-flex flex-row justify-content-between mt-4">
                                <h5 class="m-4">
                                    ویرایش
                                </h5>
                                <div>
                                    @if(Session::has('photo_deleted'))
                                        <p class="text-white session p-2 rounded">
                                            {{Session('photo_deleted')}}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                <form action="{{url('post/update/'.$post->id)}}" method="POSt" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT"/>
                                    <div class="form-group">
                                        <label for="title"> عنوان</label>
                                        <input type="text" class="my-input-style form-control" name="title" id="title" value="{{$post->title}}">
                                        @if($errors->first('title'))
                                            <p class="text-danger text-bold">{{$errors->first('title')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">

                                        <label for="city"> شهر</label>
                                        <input type="text" class="my-input-style form-control" name="city" id="city" value="{{$post->city->name}}">
                                        <input type="hidden" name="cityId" value="{{$post->city->id}}">

                                        @if($errors->first('city'))
                                            <p class="text-danger text-bold">{{$errors->first('city')}}</p>
                                        @endif
                                    </div>
                                    <input type="hidden" name="cityId" value="{{$post->city->id}}">
                                    <div class="form-group">
                                        <label for="body">متن پیام</label>
                                        <textarea id="body" class="form-control my-input-style" name="body">{{$post->body}}</textarea>
                                        @if($errors->first('body'))
                                            <p class="text-danger text-bold">{{$errors->first('body')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">

                                        <label for="food"> غذاهای سنتی</label>
                                        <input type="text" class="my-input-style form-control" name="food" id="food" value="{{$post->food}}">
                                    </div>

                                    <div class="form-group">
                                        <label id="sightseeing">مکانهای دیدنی</label>
                                        <input type="text" class="my-input-style form-control" name="sightseeing" id="sightseeing" value="{{$post->sightseeing}}">

                                    </div>

                                    <div class="form-group">
                                        <label for="photo">تصاویر</label>
                                        <input type="file" name="file[]" id="photo" accept="image/*" multiple class="form-control my-input-style">
                                    </div>

                                    <button class="btn btn-block bg-blue text-white" type="submit">ویرایش</button>

                                </form>
                            </div>


                        </div>
                    </div>

                    <div class="col-6">
                        <div class="row row-cols-3 mt-5">

                            @foreach($post->photos as $photo)
                            <div class="col mb-3">
                                <div class="card">
                                    <img src="{{url('storage/'.$photo->file)}}" alt="" class="card-img-top show-image-size">
                                    <div class="card-footer p-0">
                                        <form action="{{url('photo/delete/'.$photo->id)}}" method="POST">
                                            @csrf
                                            <input type="hidden" value="DELETE" name="_method">
                                            <button class="btn btn-block btn-sm bg-purple text-white" type="submit">
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection