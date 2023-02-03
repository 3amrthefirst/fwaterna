@extends('admin.layouts.main',[
                                'page_header'       => 'الباقات',
                                'page_description'  => ' اضافة باقه ',
                                'link' => url('admin/articles')
                                ])
@section('content')


    <!-- general form elements -->
    <div class="ibox">
        <!-- form start -->
        {!! Form::model($model,[
                                'action'=>'Admin\JoinRequestController@store',
                                'id'=>'myForm',
                                'role'=>'form',
                                'method'=>'POST',
                                'files' => true
                                ])!!}

        <div class="ibox-content">
            @include('admin.join-requests.form')
        </div>
            <div class="ibox-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
        </div>
        {!! Form::close()!!}
    </div>

@endsection
