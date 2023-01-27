@extends('admin.layouts.main',[
								'page_header'		=> 'سياسات الموقع',
								'page_description'	=> 'عرض ',
								'link' => url('admin/policies')
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="pull-left">

                @can('اضافة سياسات الموقع')
                <a href="{{url('admin/policies/create')}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> إضافة جديد
                </a>
                @endcan
            </div>



            <div class="clearfix"></div>
            <div class="clearfix"></div>
        </div>



        <div class="ibox-content">
            @if(!empty($records) && count($records)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>العنوان</th>
                        <th class="text-center">المحتوي</th>
                        @can('تعديل سياسات الموقع')
                        <th class="text-center">تعديل</th>
                        @endcan
                        @can('حذف سياسات الموقع')
                        <th class="text-center">حذف</th>
                        @endcan
                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($records as $record)
                            <tr id="removable{{$record->id}}">
                                <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>
                                <td>{{optional($record)->title}}</td>
                                <td>{!! optional($record)->content !!}</td>


                                @can('تعديل سياسات الموقع')
                                <td class="text-center"><a href="{{url('admin/policies/' . $record->id .'/edit')}}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a></td>
                                @endcan
                                @can('حذف سياسات الموقع')
                                <td class="text-center">
                                    <button
                                            id="{{$record->id}}"
                                            data-token="{{ csrf_token() }}"
                                            data-route="{{url('admin/policies/'.$record->id)}}"
                                            type="button"
                                            class="destroy btn btn-danger btn-xs">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </td>
                                @endcan

                            </tr>
                            @php $count ++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $records->render() !!}
            @else
                <div>
                    <h3 class="text-info" style="text-align: center"> لا توجد بيانات للعرض </h3>
                </div>
            @endif


        </div>
    </div>
@stop

@section('script')
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'showImageNumberLabel':false,

        })
    </script>
@stop
