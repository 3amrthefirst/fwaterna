<div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
    <label for="{{$name}}">{{$label}}</label>
    <div class="">
        {!! Form::textarea($name, $value, [
        "placeholder" => $label,
        "class" => "form-control",
        "id" => $name,
        "rows" => 5
        ]) !!}
    </div>
    <span class="help-block"><strong id="{{$name}}_error">{{$errors->first($name)}}</strong></span>
</div>
