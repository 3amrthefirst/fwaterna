<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="profile-element">
                    {{--// profile image and display name of user--}}
                    <div class="text-center">
                            <img class="rounded-circle" alt="image"  style="  width: 40%;
                            height: 50%;
                            text-align:center;
                            border-radius: 50%;"

                                src="{{asset(auth()->user()->attachmentRelation[0]->path ?? 'logo.jpeg')}}"/>
                    </div>
                    <a href="{{url('admin/update-profile')}}" class="text-center">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{Auth::user()->name}}</strong>
                            </span>
                        </span>
                    </a>
                </div>
                <div class="logo-element">
                    <img src="{{asset(auth()->user()->attachmentRelation[0]->path ?? 'photos/cartoon.png')}}" style="margin-top: 20px; margin-bottom:auto;" height="40"
                         alt="logo">
                </div>
            </li>
            <li>
                <a href="{{url('admin/home')}}">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">الرئيسية</span>
                </a>
            </li>
            @can('عرض العملاء')
            <li>
                <a href="{{url('admin/clients')}}">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span class="nav-label"> {{__('العملاء')}}</span>
                </a>
            </li>
            @endcan
            @can('عرض المحامين')
            <li disabled>
                <a href="#" >
                    <i class="fa fa-balance-scale" aria-hidden="true"></i>
                    <span class="nav-label"> {{__('الفواتير')}}</span>
                </a>
            </li>
            @endcan
            @can('عرض طلبات الإنضمام')
            <li>
                <a href="{{url('admin/join-requests')}}" aria-current="page">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                    <span class="nav-label"> {{__('الباقات')}}</span>
                </a>
            </li>
            @endcan
            @can('عرض المقالات')
            <li>
                <a href="{{url('admin/articles')}}">
                    <i class="fa fa-newspaper" aria-hidden="true"></i>
                    <span class="nav-label"> {{__('منتجات العملاء')}}</span>
                </a>
            </li>
            @endcan
            <li>
                <a href="{{url('admin/update-profile')}}">
                    <i class="fa fa-user"></i>
                    <span class="nav-label">حسابي</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
