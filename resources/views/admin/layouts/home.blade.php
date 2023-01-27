@extends('admin.layouts.main',[
                                    'page_header'       => 'الصفحة الرئيسية',
                                    'page_description'  => 'إحصائيات عامة',
                                    'link' => url('admin')
                                ])
@section('content')
@inject('clients','App\Models\Client')
@inject('contacts','App\Models\Contact')

@push('styles')
    {{-- ChartStyle --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@endpush

@push('scripts')
    {!! $line1->script() !!}
    {!! $line2->script() !!}
    {{-- {!! $pie->script() !!} --}}
@endpush

<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>العملاء</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{ $clients->count() }}</h1>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-10">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>اﻹستشارات</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">{{ $contacts->count() }}</h1>
        </div>
    </div>
</div>
<div class="ibox ">
    <div class="row">
        <div class="col-md-6">
            <div class="ibox-title">
                <h5>اﻹستشارات شهريا</h5>
            </div>
            <div class="ibox-content">
                {!! $line1->container() !!}
            </div>

        </div>
        <div class="col-md-6">
            <div class="ibox-title">
                <h5>العملاء شهريا</h5>
            </div>
            <div class="ibox-content">
                {!! $line2->container() !!}
            </div>

        </div>
    </div>

</div>

@endsection

