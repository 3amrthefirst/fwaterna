<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{config('app.name')}}</title>
    <!-- SITE LOGO -->
    <link rel="icon" type="image/png" href="{{ asset('photos/logo.png') }}" />

    <link href="{{asset('inspina/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('inspina/css/bootstrap-rtl.min.css')}}" rel="stylesheet">

    <link href="{{asset('inspina/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('inspina/css/animate.css')}}" rel="stylesheet">

    <link href="{{asset('inspina/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('inspina/css/inspina-rtl.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown ">
    <div>
        <div>
            <img src="{{asset('logo.jpeg')}}" width="80%" height="0%"/>
            {{-- <h3 class="logo-name" style="font-size: 40px;">  {{config('app.name')}} </h3> --}}
        </div>

        <br>
            {{--<div class="text-center">--}}
                {{--<img src="{{asset('uploads/logo.png')}}" style="margin-bottom: 15px;" height="200" alt="logo">--}}
            {{--</div>--}}

        <p>قم بتسجيل الدخول للمتابعة</p>
        <form class="m-t" role="form" action="{{ url('admin/login') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="البريد الالكتروني"  name="email">
                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="كلمة المرور" required="" name="password">
                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>

            {{-- <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> تذكرني
                    </label>
                </div>
            </div> --}}

            <button type="submit" class="btn btn-primary block full-width m-b">دخول</button>
        </form>
{{--        <a href="{{url('register')}}" class="btn btn-success block full-width m-b">تسجيل حساب جديد</a>--}}
        <p class="m-t">
            <small>{{config('app.name')}} &copy; {{date('Y')}}</small>
        </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('inspina/js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('inspina/js/bootstrap.min.js')}}"></script>

<!-- Custom and plugin javascript -->
{{-- <script src="{{asset('inspina/js/inspinia.js')}}"></script> --}}
</body>

</html>
