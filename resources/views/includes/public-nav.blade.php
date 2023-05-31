@include('includes.header')
<body>
    <nav @class(['navbar','pt-2','bg-blue','bold'])>
        <div @class(['container','pb-2'])>
             <ul @class(['nav'])>
                 <li @class(['nav-item'])><a href="{{url('/')}}" @class(['nav-link','my-nav-link']) >صفحه ی اصلی</a></li>
                 @can('Is_admin')
                     <li @class(['item'])><a href="{{route('admin')}}" @class(['nav-link','my-nav-link']) > مدیریت</a>
                     </li>
                 @endcan
                 <li @class(['nav-item'])><a href="{{route('gallery')}}" @class(['nav-link','my-nav-link'])>گالری</a></li>
                 <li @class(['nav-item'])><a href="{{route('about-us')}}" @class(['nav-link','my-nav-link'])>درباره ی ما</a></li>
                 <li @class(['nav-item'])><a href="{{route('contact-us')}}" @class(['nav-link','my-nav-link'])>تماس با ما</a></li>
                 @if(Auth::check())
                     <li>
                         <form action="{{route('logout')}}" method="post">
                             @csrf
                             <button type="submit" @class(['btn','btn-link','text-white'])>
                                 <i @class(['fas','fa-sign-out-alt','fa-2x'])></i>
                             </button>
                         </form>
                     </li>
                 @else
                     <li @class(['nav-item','dropdown'])>
                         <a href="#" @class(['nav-link','my-nav-link','dropdown-toggle']) id="navbarDropdownMenuLink"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i @class(['fa','fa-user','text-white'])></i>
                         </a>
                         <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                             <a href="{{route('login')}}" @class(['dropdown-item','text-purple'])>ورود به وبسایت</a>
                             <a href="{{route('register')}}"  @class(['dropdown-item','text-purple'])>عضویت</a>

                         </div>
                     </li>
                 @endif
            </ul>
            <div @class(['text-white','navbar-brand','bg-purple','p-3','pr-4','pl-4','rounded-circle'])>
                <span>T <i @class(['fa',' fa-suitcase-rolling'])></i> Experience</span>
            </div>
        </div>
    </nav>
    <section id="home">
        <div @class(['container'])>
            <div @class(['img-part','float-left','pt-5','mt-4','text-center','align-self-center'])>
                @yield('image-part')
            </div>
            <div @class(['main-part','flex-column','float-right','p-5']) style="margin-bottom: 5.4rem">
                @yield('main-part')
            </div>
        </div>

    </section>


@include('includes.footer')
