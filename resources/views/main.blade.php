@extends('includes.header')
@section('title',' وبسایت توریست')
<body>
<section id="showcase">
    <div class="cover">
        <div class="container">
            @include('includes.gallery-main-nav')
            <div @class(['content','d-flex','flex-column','text-white','justify-content-end','align-items-center','pb-5']) >

                <h1>به وبسایت گردشگری من خوش آمدید</h1>
                <p>
                    ما اینجا با هم به جاهای مختلف ایران سفر میکنیم و تجربیاتمونو به اشتراک میذاریم
                </p>
            </div>

        </div>
    </div>
</section>
