@extends('admin.layouts.main',[
                                'page_header'       => __('الرتب'),
                                'page_description'  => __('تعديل الرتبة'),
                                'link' => url('admin/role')
                                ])
@section('content')
    <!-- general form elements -->
    <div class="ibox">
        <!-- form start -->
        {!! Form::model($model,[
                                'url'=>url('Admin/roles/'.$model->id),
                                'id'=>'myForm',
                                'role'=>'form',
                                'method'=>'PUT',
                                ])!!}

        <div class="ibox-content">
            <div class="clearfix"></div>
            <br>
            @include('admin.roles.form')

            <div class="ibox-footer">
                <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
            </div>

        </div>
        {!! Form::close()!!}

    </div><!-- /.box -->

@endsection


















