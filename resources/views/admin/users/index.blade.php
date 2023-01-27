@extends('admin.layouts.main',[
								'page_header'		=> __('المستخدمين'),
								'page_description'	=> __('عرض المستخدمين'),
'link' => url('admin/users')
								])
@section('content')
    <div class="ibox ibox-primary">
        <div class="ibox-title">
            <div class="pull-left">
                @can('اضافة مستخدم')
                    <a href="{{url('admin/users/create')}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i>{{__('اضافة مستخدم جديد')}}
                    </a>
                @endcan
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="">
            {!! Form::open([
                'method' => 'GET'
            ]) !!}
            <div class="col-md-3">
                <div class="">
                    <label for="">&nbsp;</label>
                    {!! Form::text('name',old('name'),[
                        'class' => 'form-control',
                        'placeholder' => __('الاسم')
                    ]) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('role_name',old('role_name'),[
                        'class' => 'form-control',
                        'placeholder' => __('اسم الصلاحية')
                    ]) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('from',old('from'),[
                        'class' => 'form-control datepicker',
                        'placeholder' => __('بداية تاريخ الاضافة')
                    ]) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('to',old('to'),[
                        'class' => 'form-control datepicker',
                        'placeholder' => __('انتهاء تاريخ الاضافة')
                    ]) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    <button class="btn btn-flat btn-block btn-primary">{{__('بحث')}}</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        <div class="ibox-content">
            @if(!empty($users) && count($users)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>{{__('الاسم')}}</th>
                        <th>{{__('البريد الالكتروني')}}</th>
                        <th class="text-center">{{__('الصلاحيات')}}</th>
                        @can('تعديل مستخدم')
                            <th class="text-center">{{__('تعديل')}}</th>
                        @endcan
                        @can('حذف مستخدم')
                            <th class="text-center">{{__('حذف')}}</th>
                        @endcan
                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($users as $user)
                            <tr id="removable{{$user->id}}">
                                <td>{{$count}}</td>
                                <td>{{optional($user)->name}}</td>
                                <td>{{optional($user)->email}}</td>
                                @can('تعديل مستخدم')
                                    <td>
                                        @foreach($user->roles as $role)
                                            <div class="col-lg-4">
                                                <label style="    background-color: #19A689;
    color: white;
    width: 200px;
    text-align: center;
    padding: 6px 0px;
    border-radius: 6px;">{{$role->name}}</label>
                                            </div>
                                        @endforeach
                                    </td>
                                @endcan
                                @can('تعديل مستخدم')
                                    <td class="text-center"><a href="{{url('admin/users/' . $user->id .'/edit')}}"
                                                               class="btn btn-xs btn-success"><i
                                                    class="fa fa-edit"></i></a>
                                    </td>
                                @endcan
                                @can('حذف مستخدم')
                                    @if($user->id === 1 )
                                        <td class="text-center danger">{{__('لا يمكن الحذف')}}</td>
                                    @else
                                        <td class="text-center">
                                            <button id="{{$user->id}}" data-token="{{ csrf_token() }}"
                                                    data-route="{{URL::route('users.destroy',$user->id)}}"
                                                    type="button"
                                                    class="destroy btn btn-danger btn-xs"><i
                                                        class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    @endif
                                @endcan
                            </tr>
                            @php $count ++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $users->render() !!}
            @else
                <div>
                    <h3 class="text-info" style="text-align: center">{{__('لا توجد بيانات للعرض')}} </h3>
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
            'showImageNumberLabel': false,

        })
    </script>
@stop
