<div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
    <label for="{{$name}}">{{$label}}</label>
    <div class="">

        {!! Form::text($name, $value, [
        "placeholder" => $label,
        "class" => "form-control ".$plugin,
        "autocomplete" => "off",
        "max" => $max ?? \Carbon\Carbon::now()->toDateTimeString(),
        "min" => $min ?? \Carbon\Carbon::now()->subYears(200)->toDateTimeString(),
        "id" => $name
        ]) !!}
    </div>
    <span class="help-block"><strong id="{{$name}}_error">{{$errors->first($name)}}</strong></span>
</div>
