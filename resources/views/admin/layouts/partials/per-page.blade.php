{!! Form::open([
                    'method' => 'get'
                ]) !!}
@foreach(request()->query() as $key => $value)
    <input type="hidden" name="{{$key}}" value="{{$value}}">
@endforeach
<div class="row">
    <div class="col-sm-3">
        <label for="">{{__('عدد النتائج بالصفحة')}}</label>
        <div class="form-group">
            {!! Form::select('per_page',[
            '10' => '10',
            '15' => '15',
            '50' => '50',
            '75' => '75',
            '100' => '100'
        ],request('per_page'),[
            'class' => 'form-control',
            'onchange' => 'submit()',
            'placeholder' => __('عدد النتائج بالصفحة')
        ]) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}