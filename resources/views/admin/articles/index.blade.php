@extends('admin.layouts.main',[
								'page_header'		=> 'منتجات العملاء',
								'page_description'	=> 'عرض ',
								'link' => url('admin/articles')
								])
@section('content')
    <div class="ibox ibox-primary">
        <!--@can('اضافة مقالة')-->
        <!--    <div class="ibox-title">-->
        <!--        <div class="pull-left">-->
        <!--            <a href="{{url('admin/articles/create')}}" class="btn btn-primary">-->
        <!--                <i class="fa fa-plus"></i> إضافة جديد-->
        <!--            </a>-->
        <!--        </div>-->
        <!--        {{-- <div class="pull-right">-->
        <!--            <a class="btn btn-default text-green btn-sm" href=""><i class="fa fa-file-excel-o"></i></a>-->
        <!--        </div> --}}-->
        <!--        <div class="clearfix"></div>-->
        <!--    </div>-->
        <!--@endcan-->
        <div class="ibox-title">
            {!! Form::open([
                'method' => 'GET',
            ]) !!}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::text('title',request()->input('title'),[
                        'class' => 'form-control',
                            'placeholder' => 'عنوان المنتج'
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
                    <th class="text-center"> عنوان المنتج </th>
                    <th class="text-center"> المحتوى</th>
                    <th class="text-center"> السعر</th>
                    <th class="text-center">صورة الغلاف</th>
                    <th class="text-center"> تعديل</th>
                    <th class="text-center">حذف</th>
                    </thead>
                    <tbody>

                    @foreach($records as $record)
                        <tr id="removable{{$record->id}}">
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{optional($record)->title}}</td>
                            <td class="text-center">{{optional($record)->content}}</td>
                            <td class="text-center">{{optional($record)->price}}</td>
                            <td class="text-center">
                                <img src="{{asset($record->attachmentRelation->path)}}" style="width:60px;height:60px;border-raduis:100px;">
                            </td>
                            <td class="text-center">
                                @can('تعديل مقالة')
                                    <a href="{{ route('articles.edit',$record->id) }}" class="btn btn-xs btn-success"><i
                                        class="fa fa-edit"></i></a>
                                @endcan
                            </td>
                            <td class="text-center">
                                @can('حذف مقالة')
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>
                                    {{-- delete modal --}}
                                    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style>
                                        <div class="modal-dialog" role="document" style="">
                                            <div class="modal-content" style="border-radius: 10px;">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        {!! Form::open([
                                                            'action' => ['Admin\ArticleController@destroy',$record->id],
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
