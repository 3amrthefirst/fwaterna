@extends('admin.layouts.main',[
								'page_header'		=> 'اﻹستشارات',
								'page_description'	=> 'عرض ',
								'link' => url('admin/consults')
								])
@section('content')
    <div class="ibox ibox-primary">
        <div class="ibox-title">
            {!! Form::open([
                'method' => 'GET',
            ]) !!}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::text('business',request()->input('business'),[
                        'class' => 'form-control',
                        'placeholder' => 'مجال العمل'
                        ])!!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="ibox-content">
        @include('flash::message')
        @if(count($records))
            <div class="table-responsive">
                <table class="data-table table table-bordered">
                    <thead>
                        <th class="text-center"> م</th>
                        <th class="text-center">الاسم</th>
                        <th class="text-center">البريد الاكتروني</th>
                        <th class="text-center">رقم الهاتف</th>
                        <th class="text-center">مجال العمل</th>
                        <th class="text-center">اﻹستشارة</th>
                        <th class="text-center">عرض الرد المسجل</th>
                        <th class="text-center">الرد على الاستشارة</th>
                        <th class="text-center">حذف</th>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr id="removable{{$record->id}}">
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{optional($record)->full_name}}</td>
                                <td class="text-center">{{optional($record)->email}}</td>
                                <td class="text-center">{{optional($record)->phone}}</td>
                                <td class="text-center">{{optional($record)->business}}</td>
                                <td class="text-center">{{optional($record)->question}}</td>
                                <td class="text-center">
                                    {!! $record->answer?$record->answer:'<h4 class="text-danger">لم يتم الرد </h4>'!!}
                                </td>
                                <td class="text-center">
                                    @can('تعديل إستشارة')
                                        <a href="{{ route('consults.edit',$record->id) }}" class="btn btn-xs btn-success"><i
                                                class="fa fa-comment"></i></a>
                                    @endcan
                                </td>
                                <td class="text-center">
                                    @can('حذف إستشارة')
                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>
                                        {{-- delete modal --}}
                                        <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style>
                                            <div class="modal-dialog" role="document" style="">
                                                <div class="modal-content" style="border-radius: 10px;">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            {!! Form::open([
                                                                'action' => ['Admin\ConsultController@destroy',$record->id],
                                                                'method' => 'delete'
                                                                ]) !!}
                                                            <div class="col-3" style="float:right; margin-right: 35px;">
                                                                <button type="submit" class="btn btn-danger btn-md"><i class="fa fa-trash" > </i> تأكيد الحذف</button>
                                                            </div>
                                                                {!! Form::close() !!}
                                                            <div class="col-3" style="float:left; margin-left: 35px;">
                                                                <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal" >
                                                                    <i class="fa fa-times-circle"> </i> إلغاء
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                </td>
                            </tr>
                            <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content animated bounceInRight text-right">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">{{ __('إغلاق') }}</span>
                                            </button>
                                            <h4 class="modal-title">{{ __('الرد') }}</h4>
                                        </div>
                                        <div class="modal-body" style="background-color: white;">
                                            {!! Form::open([
                                                'method' => 'GET',
                                                'id' => 'myForm',
                                            ]) !!}
                                            <div class="row text-center">
                                                {!! $record->answer?$record->answer:'<h3>لم يتم الرد بعد</h3>' !!}
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                                <a href="{{ route('consults.edit',$record->id) }}" class="btn btn-success"><i
                                                    class="fa fa-edit"></i>{{ __(' تعديل ') }}</a>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                <i class="fa fa-times"></i>{{ __(' إغلاق ') }}</button>
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                {!! $records->appends(request()->all())->render() !!}
            </div>
        @else
            <div>
                <h3 class="text-info" style="text-align: center"> لا توجد بيانات للعرض </h3>
            </div>
        @endif
    </div>

@endsection
