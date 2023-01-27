@extends('admin.layouts.main',[
                                'page_header'       => config('app.name'),
                                'page_description'  => __('السجلات') ,
                                'link' => url('admin/logs')
                          ])

@section('content')
    <div class="ibox-content">
        <div class="box-body">

            <div class="box-header">
                {!! Form::open([
                       'method' => 'get'
                       ]) !!}
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::text('logable_id',request()->input('logable_id'),[
                                'class' => 'form-control',
                                'placeholder' => 'كود الإجراء'
                            ]) !!}
                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::text('user_id',request()->input('user_id'),[
                                'class' => 'form-control',
                                'placeholder' => 'كود المستخدم'
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::text('user_name',request()->input('user_name'),[
                                'class' => 'form-control',
                                'placeholder' => 'اسم  المستخدم'
                            ]) !!}
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::select('logable_type',
                                [
                                    'Client' => 'عملاء ',
                                    'Laywers' => 'الإعدادات العامة ',
                                    'User' => 'مستخدمي لوحة التحكم ',
                                ],\Request::input('logable_type'),[
                                    'class' => 'form-control',
                                    'placeholder' => 'نوع الإجراء'
                            ]) !!}
                        </div>
                    </div> --}}

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::date('from',request()->input('from'),[
                                'class' => 'form-control datepicker',
                                'placeholder' => 'من'
                            ]) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::date('to',\Request::input('to'),[
                                'class' => 'form-control datepicker',
                                'placeholder' => 'إلى'
                            ]) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <button class="btn btn-flat btn-block btn-primary">{{__('بحث')}}</button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
            @include('flash::message')
            @if(count($records))
                <div class="table-responsive">
                    <table class="data-table table table-bordered">
                        <thead>
                        <th>#</th>
                        <th class="text-center">{{__('العنوان')}}</th>
                        <th class="text-center">{{__('التفاصيل')}}</th>
                        <th class="text-center">{{__('بواسطة')}}</th>
                        <th class="text-center">{{__('نوع المستخدم')}}</th>
                        <th class="text-center">{{__('التاريخ')}}</th>
                        </thead>
                        <tbody>

                        @foreach($records as $record)
                            <tr id="removable{{$record->id}}">
                                <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>

                                <td class="text-center">{{$record->title}}</td>
                                <td class="text-center">

                                    @if($record->title != 'عملية حذف')
                                    {{$record->description}}

                                    {{-- <a href="{{$record->model_url}}"
                                       class="btn btn-info btn-xs" target="_blank">
                                        <i class="fa fa-eye"></i>
                                    </a> --}}
                                    @else
                                        {{$record->description}}
                                    @endif
                                </td>

                                <td class="text-center">

                                    <a href="{{$record->user_url}}" target="_blank">
                                        #{{$record->user_id}}
                                    </a>

                                    <br>
                                    {{optional($record->user)->name}}

                                </td>
                                <td class="text-center">{{$record->type_text}}</td>
                                <td class="text-center">
                                    {{$record->created_at->locale('ar')->isoFormat('dddd  , MMMM  ,  DD-MM-Y  ,  الساعة h:mm a')}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

        </div>
        <div class="text-center">
            {!! $records->render() !!}
        </div>
        @else
            <div>
                <h3 class="text-info" style="text-align: center"> لا توجد بيانات للعرض </h3>
            </div>
        @endif
    </div>
@endsection
