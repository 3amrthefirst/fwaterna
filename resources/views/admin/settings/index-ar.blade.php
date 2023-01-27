@extends('admin.layouts.main',[
                                'page_header'       => 'اﻹعدادات',
                                'page_description'  => 'إعدادات الموقع باللغة العربية',
                                 'link' => url('admin/settings/ar')
                                ])
@section('content')
<div class="ibox">
    <div class="ibox ibox-primary">
        <div class="ibox-content">
                <!-- form start -->
                {!! Form::model($record,[
                    'url'=>url('admin/settings/ar'),
                    'method'=>'PUT',
                    'files' => true
                    ])!!}
                @can('تعديل اﻹعدادات')
                    <button type="submit" class="btn btn-primary">حفظ الكل</button>
                    <hr/>
                    @include('admin.layouts.partials.validation-errors')
                @endcan
            {!! \Helper\Field::text('site_name[ar]','إسم الموقع',$record->gettranslation('site_name','ar'))!!}
            {!! \Helper\Field::text('about_us[ar]','من نحن',$record->gettranslation('about_us','ar'))!!}
            {!! \Helper\Field::text('goal[ar]','هدفنا',$record->gettranslation('goal','ar'))!!}
            {!! \Helper\Field::text('our_services_sub_title[ar]','العنوان الغرعي لصفحة خدماتنا',$record->gettranslation('our_services_sub_title','ar'))!!}
            {!! \Helper\Field::text('commercial_issues_sub_title[ar]','العنوان الغرعي لصفحة التعداد',$record->gettranslation('commercial_issues_sub_title','ar'))!!}
            {!! \Helper\Field::text('our_team_sub_title[ar]','العنوان الغرعي لصفحة فريقنا',$record->gettranslation('our_team_sub_title','ar'))!!}
            {!! \Helper\Field::text('our_clients_sub_title[ar]','العنوان الغرعي لصفحة عملائنا',$record->gettranslation('our_clients_sub_title','ar'))!!}
            {!! \Helper\Field::text('faq_sub_title[ar]','العنوان الغرعي لصفحة الإستشارات',$record->gettranslation('faq_sub_title','ar'))!!}
            {!! \Helper\Field::text('blog_sub_title[ar]','العنوان الغرعي لصفحة المدونة',$record->gettranslation('blog_sub_title','ar'))!!}
        </div>
    </div>
    {!! Form::close()!!}
</div>
@endsection
