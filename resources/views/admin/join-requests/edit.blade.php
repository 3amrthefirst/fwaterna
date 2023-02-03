
@extends('admin.layouts.main',[
                                'page_header'       => 'الباقات',
                                'page_description'  => ' تعديل   ',
                                'link' => url('admin/join-requests')
                                ])
@section('content')
        <!-- general form elements -->
<div class="ibox">
    <!-- form start -->
    {!! Form::model($model,[
                            'url'=>url('admin/join-requests/'.$model->id),
                            'id'=>'myForm',
                            'role'=>'form',
                            'method'=>'PUT',
                            'files' => true
                            ])!!}

    <div class="ibox-body">
        <div class="clearfix"></div>
        <br>
        <div class="ibox-content">
            @include('admin.join-requests.form')
        </div>

        <div class="ibox-footer">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>

    </div>
    {!! Form::close()!!}

</div><!-- /.box -->

@endsection
