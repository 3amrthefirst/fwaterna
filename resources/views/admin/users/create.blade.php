@extends('admin.layouts.main',[
                                'page_header'       => __('المستخدمين'),
                                'page_description'  => __('اضافة مستخدم جديد'),
                                'link' =>url('admin/role')
                                ])


@section('content')
    <!-- general form elements -->
    <div class="ibox ibox-primary">
        <!-- form start -->
        {!! Form::model($model,[
                                'action'=>'Admin\UserController@store',
                                'id'=>'myForm',
                                'role'=>'form',
                                'method'=>'POST',
                                'files' => true
                                ])!!}

        <div class="ibox-content">

            @include('admin.users.form')

            <div class="ibox-footer">
                <button type="submit" class="btn btn-primary">{{__('حفظ')}}</button>
            </div>

        </div>
        {!! Form::close()!!}

    </div><!-- /.box -->

@endsection
