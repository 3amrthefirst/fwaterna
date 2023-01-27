@extends('admin.layouts.main',[
								'page_header'		=> 'طلبات الإنضمام',
								'page_description'	=> 'عرض ',
								'link' => url('admin/join-requests')
								])
@section('content')
    <div class="ibox-content">
        @include('flash::message')
        @if(count($records))
            <div class="table-responsive">
                <table class="data-table table table-bordered">
                    <thead>
                    <th class="text-center"> م</th>
                    <th class="text-center">التاريخ</th>
                    <th class="text-center">تحميل السيرة الذاتية</th>
                    <th class="text-center">حذف</th>
                    </thead>
                    <tbody>

                    @foreach($records as $record)
                        <tr id="removable{{$record->id}}">
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{$record->created_at}}</td>
                            <td class="text-center">
                                <a href="{{route('download-pdf',$record->id)}}" class="btn btn-xs btn-primary ">
                                    <i class="fa fa-download"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                @can('حذف طلب إنضمام')
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>
                                    {{-- delete modal --}}
                                    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style>
                                        <div class="modal-dialog" role="document" style="">
                                            <div class="modal-content" style="border-radius: 10px;">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        {!! Form::open([
                                                            'action' => ['Admin\JoinRequestController@destroy',$record->id],
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
