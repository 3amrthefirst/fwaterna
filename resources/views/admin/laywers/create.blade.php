@extends('admin.layouts.main',[
                                'page_header'       => 'فريق العمل',
                                'page_description'  => ' اضافة عميل ',
                                'link' => url('admin/laywers')
                                ])
@section('content')


    <!-- general form elements -->
    <div class="ibox">
        <!-- form start -->
        {!! Form::model($model,[
                                'action'=>'Admin\LaywerController@store',
                                'id'=>'myForm',
                                'role'=>'form',
                                'method'=>'POST',
                                'files' => true
                                ])!!}

        <div class="ibox-content">
            @include('admin.laywers.form')
        </div>
            <div class="ibox-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
        </div>
        {!! Form::close()!!}
    </div>

@endsection
