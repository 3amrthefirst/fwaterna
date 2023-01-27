
@extends('admin.layouts.main',[
                                'page_header'       => 'سياسات الموقع',
                                'page_description'  => ' تعديل   ',
                                'link' => url('admin/policies')
                                ])
@section('content')
        <!-- general form elements -->
<div class="box box-primary">
    <!-- form start -->
    {!! Form::model($model,[
                            'url'=>url('admin/policies/'.$model->id),
                            'id'=>'myForm',
                            'role'=>'form',
                            'method'=>'PUT',
                            'files' => true
                            ])!!}

    <div class="box-body">
        <div class="clearfix"></div>
        <br>
        @include('admin.policies.form')

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>

    </div>
    {!! Form::close()!!}

</div><!-- /.box -->

@endsection
