@extends('admin.layouts.main',[
								'page_header'		=> __('الرتب'),
								'page_description'	=> __('كل الرتب'),
								'link' => url('admin/role')
								])
{{----}}


@section('content')
    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="pull-left">
                @can('اضافة رتبة')
                <a href="{{url('admin/roles/create')}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> {{ __('اضافة صلاحية جديده') }}
                </a>
                @endcan
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            {!! Form::open([
                'method' => 'GET'
            ]) !!}
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('name',old('name'),[
                        'class' => 'form-control',
                        'placeholder' => __('الأسم')
                    ]) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('from',old('from'),[
                        'class' => 'form-control datepicker',
                        'placeholder' => __('بداية تاريخ الاضافة'),
                                'autocomplete' => 'off',
                    ]) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('to',old('to'),[
                        'class' => 'form-control datepicker',
                        'placeholder' => __('انتهاء تاريخ الاضافة'),
                                'autocomplete' => 'off',
                    ]) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    <button class="btn btn-flat btn-block btn-primary">{{ __('بحث') }}</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        <div class="ibox-content">
            @if(!empty($roles) && count($roles)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>{{ __('الأسم') }} </th>
                        <th class="text-center">{{ __('التفاصيل') }}</th>
                        @can('تعديل رتبة')
                        <th class="text-center">{{ __('تعديل') }}</th>
                        @endcan
                        @can('حذف رتبة')
                        <th class="text-center">{{ __('حذف') }}</th>
                        @endcan
                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($roles as $role)

                            <tr id="removable{{$role->id}}">
                                <td>{{$count}}</td>
                                <td>{{optional($role)->name}}</td>
                                <td>
                                    <center>
                                        <button style="background-color: white;border: none" data-toggle="modal"
                                                data-target="#client{{$role->id}}"
                                        >
                                            <i class="btn btn-xs btn-info fa fa-eye" style="padding: 4px 6px"></i>
                                        </button>
                                    </center>

                                    <!-- Modal -->
                                    <div class="modal fade" id="client{{$role->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel">

                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span aria-hidden="true">&times;</span>
                                                    </button>


                                                    <h2 style="font-weight: bold" class="modal-title"
                                                        id="myModalLabel">{{$role->name}}</h2>
                                                </div>

                                                <div class="modal-body">
                                                    <p><strong>التفاصيل  : </strong> {!! $role->description !!}</p>
                                                    <p><strong>التحكم  : </strong> </p>
                                                    @if($role->permissions->isEmpty())
                                                        <h3 class="text-bold" style="text-align: center"> {{ __('لم يتم اختيار صلاحيات بعد') }}  ..</h3>
                                                    @endif
                                                    @php
                                                        $title = '';
                                                    @endphp
                                                    @foreach($role->permissions as $perm)
                                                        {{--                                                        @if(var_dump($perm->isEmpty()))--}}

                                                        {{--                                                            <h3 class="text-info" style="text-align: center"> لا توجد بيانات للعرض </h3>--}}
                                                        {{--                                                        @endif--}}
                                                        @if ($loop->first)
                                                            @php
                                                                $title = $perm->description;

                                                            @endphp

                                                            <div class="clearfix"></div>
                                                            <br>
                                                            <br>
                                                            <div class="text-center">
                                                                <label style="    font-size: 1.6rem;
    color: #3c8cbc;">{{$perm->description}}</label>
                                                                <hr style="    width: 149px;
    padding: 1px 2px;
    background-color: #3c8cbc;">


                                                            </div>
                                                        @endif
                                                        @if($perm->description != $title)
                                                            <div class="clearfix"></div>
                                                            <br>
                                                            <br>
                                                            <div class="text-center">
                                                                <label style="    font-size: 1.6rem;
color: #3c8cbc;">{{$perm->description}}</label>
                                                                <hr style="    width: 149px;
padding: 1px 2px;
background-color: #3c8cbc;">

                                                            </div>
                                                        @endif
                                                        <div class="col-sm-4">
                                                            <label style="   background-color: #04b904;
    color: white;
    border-radius: 6px;
    width: 100%;
    text-align: center;
    padding: 18px 0px;">{{$perm->name}}</label>
                                                        </div>
                                                        @php
                                                            $title = $perm->description;
                                                        @endphp

                                                    @endforeach
                                                    <br>
                                                    <br>
                                                </div>
                                                <div class="clearfix"></div>
                                                <br>
                                                <div class="modal-footer">
                                                    <p><strong>{{ __('تاريخ الاضافة') }}
                                                            : </strong> {{$role->created_at->locale('ar')->isoFormat('dddd  , MMMM  ,  Do / YYYY  ,  الساعة h:mm')}}
                                                    </p>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"
                                                            style="background-color: #00c0ef;color: white">
                                                        إغلاق
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @can('تعديل رتبة')
                                <td class="text-center"><a href="{{url('admin/roles/' . $role->id .'/edit')}}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a></td>
                                @endcan
                                @can('حذف رتبة')
                                <td class="text-center">
                                    <button id="{{$role->id}}" data-token="{{ csrf_token() }}" data-route="{{url('admin/roles/'.$role->id)}}"  type="button" class="destroy btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                </td>
                                @endcan
                            </tr>
                            @php $count ++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $roles->render() !!}
            @else
                <div>
                    <h3 class="text-info" style="text-align: center"> {{ __('لا توجد بيانات للعرض') }} </h3>
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
