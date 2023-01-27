@extends('admin.layouts.main',[
                                'page_header'       => __('الصلاحيات'),
                                'page_description'  => __('صلاحية جديدة'),
                                'link' => url('admin/role')
                                ])
@section('content')
        <!-- general form elements -->
<div class="ibox">
    <!-- form start -->
    {!! Form::model($model,[
                            'action'=>'Admin\RoleController@store',
                            'id'=>'myForm',
                            'role'=>'form',
                            'method'=>'POST',

                            ])!!}

    <div class="ibox-content">

        @include('admin.roles.form')

        <div class="ibox-footer">
            <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
        </div>

    </div>
    {!! Form::close()!!}

</div><!-- /.box -->

@endsection
