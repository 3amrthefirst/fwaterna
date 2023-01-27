@include('admin.layouts.head')


<div id="wrapper">

@include('admin.layouts.sidebar')

<div id="page-wrapper" class="gray-bg">
    @include('admin.layouts.header')
    <section class="content-header">
        <h1>
            <a href="{{$link}}">

                {{$page_header}}
            </a>
            <small>{!! $page_description !!}</small>
        </h1>
    </section>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                @yield('content')

                <div class="col-lg-3">
                    <div class="wrapper wrapper-content post-manager">

                        <div class="sidebar-collapse">
                            <ul class="nav metismenu" id="side-menu">

                                @foreach($sections as $section2)

                                <li>
                                    <a href="{{route($section2->route)}}">
                                        <i class="{{$section2->icon}}"></i>
                                        <span class="nav-label">{{$section2->display_name}}</span>
                                    </a>
                                </li>

                                @endforeach

                            </ul>
                            <br>
                            <br>
                        </div>
                    </div>


                </div>
            </div>
        </div>

            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
</div>
@include('admin.layouts.foot')