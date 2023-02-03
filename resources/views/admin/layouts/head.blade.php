<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- SITE LOGO -->
        <link rel="icon" type="image/png" href="{{ asset('logo.jpeg') }}" />
        <link href="{{ asset('photos/fav.png') }}" rel="apple-touch-icon">
         <title>
        لوحة التحكم
        </title> 
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link href="{{ asset('inspina/css/bootstrap.min.css') }}" rel="stylesheet">


        <link href="{{ asset('inspina/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('inspina/Ionicons/css/ionicons.min.css') }}">
        <link href="{{ asset('inspina/css/animate.css') }}" rel="stylesheet">

        {{-- <link href="{{ asset('inspina/css/toastr.min.css') }}" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{ asset('inspina/js/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('inspina/js/plugins/selectize/selectize.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('inspina/js/plugins/sweetalert/sweetalert.css') }}">
        <link rel="stylesheet" href="{{ asset('inspina/js/plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
        <link rel="stylesheet" href="{{ asset('inspina/js/plugins/lightbox2/css/lightbox.min.css') }}">
        <link href="{{ asset('inspina/css/datatables.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="{{ asset('css/summernote.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.7.0/switchery.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('inspina/plugins/hijri-calender/css/jquery.calendars.picker.css') }}">
        {{-- @if (app()->getLocale() == 'en')
        <link href="{{ asset('inspina/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('inspina/css/custom.css') }}" rel="stylesheet">
        @else --}}
        <link href="{{ asset('inspina/css/bootstrap-rtl.min.css') }}" rel="stylesheet">
        <link href="{{ asset('inspina/css/inspina-rtl.css') }}" rel="stylesheet">
        {{-- <link href="{{ asset('inspina/css/custom-rtl.css') }}" rel="stylesheet"> --}}

        {{-- @endif --}}
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
            integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.1/css/flag-icon.min.css">
        


    <style>
        #toast-container > .toast {
            background-image: none !important;
            padding-top: 30px;
            padding-bottom: 30px;
        }

        #toast-container > .toast-success {
            background-color: #3c8dbc;
        }

        #toast-container > .toast:before {
            position: relative;
            font-family: FontAwesome;
            font-size: 24px;
            line-height: 18px;
            float: left;
            margin-left: -1em;
            color: #FFF;
            padding-right: 0.5em;
            margin-right: 0.5em;
        }

        #toast-container > .toast-success:before {
            content: "\f003";
        }
    </style>
    @if($errors->any())
        <style>
                #myForm {
                    border: 2px solid #e9a1a8;
                }
        </style>
    @endif

    <script>
        window.laravelUrl = "{{ url('/') }}";

    </script>



    <style>
        .html5buttons {
            float: left;
            clear: right;
        }
    </style>
    @stack('styles')
</head>

<body>

{{--<audio id="myAudio" style="display: none">--}}
{{--    <source src="{{asset('notification/notification_rang.mp3')}}" type="audio/ogg">--}}
{{--</audio>--}}
