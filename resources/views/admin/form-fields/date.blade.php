<div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
    <label for="{{$name}}">{{$label}}</label>
    <div class="">

        {!! Form::date($name, $value , [
        "placeholder" => $label,
        "class" => "form-control ",
        "max" => $max ? $max : null,
        "min" => $min ? $min : null,
        "autocomplete" => "off",
        "id" => $name
        ]) !!}
    </div>
    <span class="help-block"><strong id="{{$name}}_error">{{$errors->first($name)}}</strong></span>
</div>