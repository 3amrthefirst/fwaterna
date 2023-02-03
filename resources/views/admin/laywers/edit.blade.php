
@extends('admin.layouts.main',[
                                'page_header'       => 'فريق العمل',
                                'page_description'  => ' الرد',
                                'link' => url('admin/laywers')
                                ])
@section('content')
        <!-- general form elements -->
<div class="ibox">

            <!-- form start -->
    {!! Form::model($model,[
                            'url'=>url('admin/laywers/'.$model->id),
                            'id'=>'myForm',
                            'role'=>'form',
                            'method'=>'PUT',
                            'files' => true
                            ])!!}

    <div class="ibox-body">
        <div class="clearfix"></div>
        <br>
        <div class="ibox-content">
            @include('admin.laywers.form')

        </div>

        <div class="ibox-footer">
            <button type="submit" class="btn btn-primary">الرد</button>
        </div>

    </div>
    {!! Form::close()!!}

</div><!-- /.box -->

@endsection
