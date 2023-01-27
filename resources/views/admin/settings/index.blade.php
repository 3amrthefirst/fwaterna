@extends('admin.layouts.main',[
                                'page_header'       => 'اﻹعدادات',
                                'page_description'  => 'إعدادات عامة',
                                 'link' => url('admin/settings/ar')
                                ])
@section('content')
    <!-- form start -->
    {!! Form::model($record,[
        'url'=>url('admin/settings/main'),
        'method'=>'PUT',
        'files' => true
        ])!!}
    @can('تعديل اﻹعدادات')
        <button type="submit" class="btn btn-primary" style="margin-right: 15px; margin-bottom: 20px;">حفظ الكل</button>
        @include('admin.layouts.partials.validation-errors')
    @endcan
    <div class="col-lg-12">
        <div class="ibox border-bottom ">
            <div class="ibox-title collapse-link">
                <h5 style="color: #3c8dbc ;font-weight: bold">بيانات التواصل</h5>
                <div class="ibox-tools">
                    <a class="">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content" style="display: none;">
                {!! \Helper\Field::text('phone','رقم الهاتف',$record->phone)!!}
                {!! \Helper\Field::text('email','البريد اﻹلكتروني',$record->email)!!}
                {!! \Helper\Field::text('twitter','لينك حساب تويتر',$record->twitter)!!}
                {!! \Helper\Field::text('linkedin','لينك حساب لينكد إن',$record->linkedin)!!}
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="ibox border-bottom ">
            <div class="ibox-title collapse-link">
                <h5 style="color: #3c8dbc ;font-weight: bold">بيانات التعداد</h5>
                <div class="ibox-tools">
                    <a class="">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content" style="display: none;">
                {!! \Helper\Field::number('expert_laywers','عدد المحامين الخبراء',$record->expert_laywers)!!}
                {!! \Helper\Field::number('closed_cases','عدد القضايا المغلغة',$record->closed_cases)!!}
                {!! \Helper\Field::number('successful_casses','عدد الحالات الناجحة',$record->successful_casses)!!}
                {!! \Helper\Field::number('trusted_client','عدد العملاء الموثوق بهم',$record->trusted_client)!!}
            </div>
        </div>
    </div>
    {!! Form::close()!!}
@endsection
