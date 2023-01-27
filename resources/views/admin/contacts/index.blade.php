@extends('admin.layouts.main',[
								'page_header'		=> 'رسائل التواصل',
								'page_description'	=> 'عرض ',
								'link' => url('admin/contacts')
								])
@section('content')
    <div class="ibox-content">
        @include('flash::message')
        @if(count($records))
            <div class="table-responsive">
                <table class="data-table table table-bordered">
                    <thead>
                    <th class="text-center"> م</th>
                    <th class="text-center">الإسم</th>
                    <th class="text-center"> رقم الهاتف </th>
                    <th class="text-center"> البريد الالكتروني</th>
                    <th class="text-center"> الرسالة</th>
\                    <th class="text-center">حذف</th>
                    </thead>
                    <tbody>

                    @foreach($records as $record)
                        <tr id="removable{{$record->id}}">
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{optional($record)->name}}</td>
                            <td class="text-center">{{optional($record)->phone}}</td>
                            <td class="text-center">{{optional($record)->email}}</td>
                            <td class="text-center">{{optional($record)->message}}</td>
                            <td class="text-center">
                                @can('حذف رسالة تواصل')
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>
                                    {{-- delete modal --}}
                                    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style>
                                        <div class="modal-dialog" role="document" style="">
                                            <div class="modal-content" style="border-radius: 10px;">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        {!! Form::open([
                                                            'action' => ['Admin\ContactController@destroy',$record->id],
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
