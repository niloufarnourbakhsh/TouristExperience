@extends('includes.public-nav')
@section('title','درباره ی ما')

    @section('image-part')
        <img src="{{url('img/5-01-858x463.jpeg')}}" alt="" @class(['rounded-circle', 'image-style'])>
    @endsection


    @section('main-part')

        <div @class(['about','text-right', 'text-bold', 'mt-4',' p-5'])>
            <p>
                سلام
            </p>
            <p>
                من نیلوفر هستم
            </p>
            <p>
                شهر به شهر ایران رو میگردم و خاطرات و تجربیاتمو با شما به اشتراک میذارم
            </p>
            <p>
                خوشحال میشم که عضو وبسایتم بشید و تجربیات خودتونم با من به اشتراک بذارید.
            </p>
        </div>
    @endsection
