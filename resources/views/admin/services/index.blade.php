@extends('admin.layouts.main',[
								'page_header'		=> 'خدماتنا',
								'page_description'	=> 'عرض ',
								'link' => url('admin/services')
								])
@section('content')
    <div class="ibox ibox-primary">
        {{-- @can('اضافة مقالة')
            <div class="ibox-title">
                <div class="pull-left">
                    <a href="{{url('admin/articles/create')}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> إضافة جديد
                    </a>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default text-green btn-sm" href=""><i class="fa fa-file-excel-o"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
        @endcan --}}
        {{-- <div class="ibox-title">
            {!! Form::open([
                'method' => 'GET',
            ]) !!}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::text('title',request()->input('title'),[
                        'class' => 'form-control',
                            'placeholder' => 'عنوان المقالة'
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
        </div> --}}
    </div>
    <div class="ibox-content">
        @include('flash::message')
        @if(count($records))
            <div class="table-responsive">
                <table class="data-table table table-bordered">
                    <thead>
                    <th class="text-center"> م</th>
                    <th class="text-center">العنوان الرئيسي ar</th>
                    <th class="text-center">العنوان الرئيسي en</th>
                    <th class="text-center">المحتوى ar</th>
                    <th class="text-center">المحتوى en</th>
                    <th class="text-center">الصورة</th>
                    <th class="text-center"> تعديل</th>
                    {{-- <th class="text-center">حذف</th> --}}
                    </thead>
                    <tbody>

                    @foreach($records as $record)
                        <tr id="removable{{$record->id}}">
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{$record->gettranslation('title','ar')}}</td>
                            <td class="text-center">{{$record->gettranslation('title','en')}}</td>
                            <td class="text-center">{{$record->gettranslation('content','ar')}}</td>
                            <td class="text-center">{{$record->gettranslation('content','en')}}</td>
                            <td class="text-center">
                                <img src="{{asset($record->attachmentRelation?$record->attachmentRelation->path:'front/images/logo1.svg')}}" style="width:60px;height:60px;border-raduis:100px;">
                            </td>
                            <td class="text-center">
                                @can('تعديل مقالة')
                                    <a href="{{ route('services.edit',$record->id) }}" class="btn btn-xs btn-success"><i
                                        class="fa fa-edit"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{-- {!! $records->appends(request()->all())->render() !!} --}}
            </div>


        @else
            <div>
                <h3 class="text-info" style="text-align: center"> لا توجد بيانات للعرض </h3>
            </div>
        @endif
    </div>

@endsection
