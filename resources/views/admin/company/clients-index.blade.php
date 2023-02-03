@extends('admin.layouts.main',[
								'page_header'		=> 'عملاء الشركات',
								'page_description'	=> 'عرض ',
								'link' => url('admin/companies')
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
                        {!! Form::text('name',request()->input('group'),[
                        'class' => 'form-control',
                            'placeholder' => 'اسم العميل'
                        ])!!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::text('phone',request()->input('phone'),[
                            'class' => 'form-control',
                            'placeholder' => 'رقم الهاتف'
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::text('email',request()->input('email'),[
                            'class' => 'form-control',
                            'placeholder' => 'الايميل'
                        ]) !!}
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
                    <th class="text-center">اسم العميل </th>
                    <th class="text-center"> رقم الهاتف </th>
                    <th class="text-center"> البريد الالكتروني</th>
                    </thead>
                    <tbody>

                    @foreach($records as $record)
                        <tr id="removable{{$record->id}}">
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{optional($record)->name}}</td>
                            <td class="text-center">{{optional($record)->phone}}</td>
                            <td class="text-center">{{optional($record)->email}}</td>
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
