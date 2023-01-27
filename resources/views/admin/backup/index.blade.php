@extends('admin.layouts.main',[
                                'page_header'       =>'',
                                'page_description'  => __('لوحة التحكم'),
                                'link' => ''
                                ])

@section('content')
    <div class="ibox">
        <div class="ibox-content">
            <h2 class="text-center">{{ __('نسخ إحتياطي لقاعدة بيانات النظام') }}</h2>
            <form action="{{ route('db-download') }}" method="POST">
                {{ csrf_field() }}
                <div class="text-center">
                    <button class="btn btn-primary btn-lg"><i class="fa fa-download"></i> {{ __('تحميل') }}</button>
                </div>
            </form>
        </div>
    </div>

    <div class="ibox">
        <div class="ibox-content">
            <h2 class="text-center">{{ __('استعادة النسخ الإحتياطي لقاعدة بيانات النظام') }}</h2>
            <form action="{{ route('db-upload') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="text-center">
                    {!! \Helper\Field::fileWithPreview('upload',"") !!}
                    <button type="submit" class="btn btn-info btn-lg"><i class="fa fa-upload"></i> {{ __('رفع') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
