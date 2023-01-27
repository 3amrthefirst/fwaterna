@extends('admin.layouts.main',[
                                'page_header'       => 'سياسات الموقع',
                                'page_description'  => '   ',
                                'link' => url('admin/policies')
                                ])
@section('content')


    <!-- general form elements -->
    <div class="box box-primary">
        <!-- form start -->
        {!! Form::model($model,[

                                'action'=>'Admin\PolicyController@store',
                                'id'=>'myForm',
                                'role'=>'form',
                                'method'=>'POST',
                                'files' => true
                                ])!!}

        <div class="box-body">

            @include('admin.policies.form')

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>

        </div>
        {!! Form::close()!!}

    </div><!-- /.box -->

@endsection
