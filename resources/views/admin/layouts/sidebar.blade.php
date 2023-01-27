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

                                src="{{asset(auth()->user()->attachmentRelation[0]->path ?? 'photos/cartoon.png')}}"/>
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
            <li>
                <a href="{{url('admin/laywers')}}">
                    <i class="fa fa-balance-scale" aria-hidden="true"></i>
                    <span class="nav-label"> {{__('المحامين')}}</span>
                </a>
            </li>
            @endcan
            @can('عرض اﻹستشارات')
            <li>
                <a href="{{url('admin/consults')}}">
                    <i class="fa fa-handshake" aria-hidden="true"></i>
                    <span class="nav-label"> {{__('اﻹستشارات')}}</span>
                </a>
            </li>
            @endcan
            @can('عرض طلبات الإنضمام')
            <li>
                <a href="{{url('admin/join-requests')}}">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                    <span class="nav-label"> {{__('طلبات الإنضمام')}}</span>
                </a>
            </li>
            @endcan
            @can('عرض المقالات')
            <li>
                <a href="{{url('admin/articles')}}">
                    <i class="fa fa-newspaper" aria-hidden="true"></i>
                    <span class="nav-label"> {{__('المقالات')}}</span>
                </a>
            </li>
            @endcan
            @can('عرض رسائل التواصل')
            <li>
                <a href="{{url('admin/contacts')}}">
                    <i class="fa fa-comment" aria-hidden="true"></i>
                    <span class="nav-label"> {{__('رسائل التواصل')}}</span>
                </a>
            </li>
            @endcan
            @can('عرض السجلات')
            <li>
                <a href="{{url('admin/logs')}}">
                    <i class="fa fa-copy" aria-hidden="true"></i>
                    <span class="nav-label">{{__('السجلات')}}</span>
                </a>
            </li>
            @endcan
            @canany('عرض المستخدمين','عرض الرتب')
            <li>
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">المستخدمين</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
            @can('عرض المستخدمين')
                    <li><a href="{{url('admin/users')}}">المستخدمين</a></li>
            @endcan
            @can('عرض الرتب')
                    <li><a href="{{url('admin/roles')}}"> رتب المستخدمين</a></li>
            @endcan
                </ul>
            </li>
            @endcan
            @can('عرض اﻹعدادات')
            <li>
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span class="nav-label">الإعدادات</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{url('admin/settings/main')}}">إعدادات عامة</a></li>
                    <li><a href="{{route('services.index')}}">{{__('الخدمات')}}</a></li>
                    <li><a href="{{url('admin/settings/ar')}}">اﻹعدادات باللغة العربية</a></li>
                    <li><a href="{{url('admin/settings/en')}}">اﻹعدادات باللغة اﻹنجليزية</a></li>
                </ul>
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
