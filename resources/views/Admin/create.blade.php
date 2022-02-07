@extends('includes.admin-base')

@section('context')
    <div class="container">
        <div class="row ">
            <div class="col-12 justify-content-end  align-self-end">

                <div class="row">
                    <div class="col-6">
                        <div class="d-flex flex-column align-self-end mb-4">
                            <div class="d-flex flex-row">
                                <h5 class="m-4">
                                    ایجاد پیام جدید
                                </h5>
                            </div>
                            <div class="text-right">

                            <form action="{{url('/post/store')}}" method="POSt" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">

                                    <label for="title"> عنوان</label>
                                    <input type="text" class="my-input-style form-control" name="title" id="title" value="{{old('title')}}">
                                    @if($errors->first('title'))
                                        <p class="text-danger text-bold">{{$errors->first('title')}}</p>
                                    @endif
                                </div>
                                <div class="form-group">

                                    <label for="city"> شهر</label>
                                    <input type="text" class="my-input-style form-control" name="city" id="city" value="{{old('city')}}">
                                    @if($errors->first('city'))
                                        <p class="text-danger text-bold">{{$errors->first('city')}}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="body">متن پیام</label>
                                    <textarea id="body" class="form-control my-input-style" name="body">{{old('body')}}</textarea>
                                    @if($errors->first('body'))
                                        <p class="text-danger text-bold">{{$errors->first('body')}}</p>
                                    @endif
                                </div>
                                <div class="form-group">

                                    <label for="food"> غذاهای سنتی</label>
                                    <input type="text" class="my-input-style form-control" name="food" id="food" value="{{old('food')}}">
                                </div>

                                <div class="form-group">
                                    <label id="sightseeing">مکانهای دیدنی</label>
                                    <input type="text" class="my-input-style form-control" name="sightseeing" id="sightseeing" value="{{old('sightseeing')}}">

                                </div>

                                <div class="form-group">
                                    <label for="photo">تصاویر</label>
                                    <input type="file" name="file[]" id="photo" accept="image/*" multiple class="form-control my-input-style">
                                    @if($errors->first('file'))
                                        <p class="text-danger text-bold">{{$errors->first('file')}}</p>
                                    @endif
                                </div>

                                <button class="btn btn-block bg-blue text-white" type="submit">ذخیره</button>

                            </form>

                            </div>

                        </div>
                    </div>

                    <div class="col-6">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection