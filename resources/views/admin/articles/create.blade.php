@extends('admin.layouts.main',[
                                'page_header'       => 'المقالات',
                                'page_description'  => ' اضافة مقالة ',
                                'link' => url('admin/articles')
                                ])
@section('content')


    <!-- general form elements -->
    <div class="ibox">
        <!-- form start -->
        {!! Form::model($model,[
                                'action'=>'Admin\ArticleController@store',
                                'id'=>'myForm',
                                'role'=>'form',
                                'method'=>'POST',
                                'files' => true
                                ])!!}

        <div class="ibox-content">
            @include('admin.articles.form')
        </div>
            <div class="ibox-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
        </div>
        {!! Form::close()!!}
    </div>

@endsection
