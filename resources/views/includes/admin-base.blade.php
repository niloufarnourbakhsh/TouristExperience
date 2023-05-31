@include('includes.header')
<body id="admin">
<nav id="admin-nav" @class(['text-bold'])>
    <div @class(['container','nav','d-flex','justify-content-between','pt-3'])>

        <div @class(['nav-item'])>
            <h3>مدیریت</h3>
        </div>
        <div  @class(['nav-item'])>
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button @class(['btn','btn-link','text-yellow','exit']) type="submit">
                    <i @class(['fas','fa-sign-out-alt','fa-2x'])></i>
                </button>
            </form>
        </div>
    </div>
</nav>
<div @class(['admin-hr','bg-black','m-auto'])></div>
<section id="manager">

    <div @class(['container-fluid'])>
        <div @class(['row'])>
            <div @class(['col-1'])></div>
            <div id="admin-menu" @class(['col-2'])>
                <ul @class(['nav','nav-fill','flex-column','justify-content-end','text-right','float-right','pt-5'])>
                    <li @class(['nav-item','p-3','bottom-border-orange'])>
                        <a href="{{url('/admin')}}" @class(['nav-link','text-white'])>صفحه ی اصلی</a>
                    </li>

                    <li @class(['nav-item','p-3','bottom-border-orange'])>
                        <a href="{{route('post.create')}}" @class(['nav-link','text-white']) >افزودن مطلب جدید</a>
                    </li>

                    <li @class(['nav-item','p-3','bottom-border-orange'])>
                        <a href="{{route('users')}}" @class(['nav-link','text-white'])>مدیریت اعضا</a>
                    </li>

                    <li @class(['nav-item','p-3','bottom-border-orange'])>
                        <a href="{{route('comments.show')}}" @class(['nav-link','text-white'])>مدیریت نظرات </a>
                    </li>

                    <li @class(['nav-item','p-3'])>
                        <a href="{{route('messages')}}" @class(['nav-link','text-white']) >مدیریت پیامها </a>
                    </li>
                </ul>
            </div>

            <div id="content" @class(['col-8','float-left','admin-bg','mt-3','rounded','mb-4'])>
                <div @class(['container','d-flex','flex-column','justify-content-end','align-items-center'])>
                    @yield('context')
                </div>

            </div>
            <div @class(['col-1'])></div>

        </div>

    </div>
</section>
<script type="text/javascript" src="{{asset('css\tinymce\tinymce.min.js')}}"></script>
<script>tinymce.init({selector: 'textarea'});</script>
</body>
</html>



