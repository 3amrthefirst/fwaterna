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
                </div>
            </div>
        </div>

{{--        @include('admin.layouts.footer')--}}
        @include('admin.layouts.foot')

    </div>

</div>
