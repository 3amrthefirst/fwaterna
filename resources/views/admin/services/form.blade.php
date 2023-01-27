{!! \Helper\Field::text('title[ar]','العنوان الرئيسي ar',$model->gettranslation('title','ar'))!!}
{!! \Helper\Field::text('title[en]','العنوان الرئيسي en',$model->gettranslation('title','en'))!!}
{!! \Helper\Field::text('content[ar]','المحتوى ar',$model->gettranslation('content','ar'))!!}
{!! \Helper\Field::text('content[en]','المحتوى en',$model->gettranslation('content','en'))!!}
{!! \App\MyHelper\Field::fileWithPreview('image','الصورة') !!}

{{-- <hr>
{!! \App\MyHelper\Field::datePicker('start_subscription','تاريخ بداية الاشتراك') !!}
{!! \App\MyHelper\Field::datePicker('end_subscription','تاريخ انتهاء الاشتراك') !!}
<hr> --}}




