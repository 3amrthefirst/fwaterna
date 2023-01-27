<div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
    <label for="{{$name}}">{{$label}}</label>
    <div class="">

        {!! Form::textarea($name, $value, [
                    "class" => "form-control " . $plugin,
                     "id" => $name,
           "placeholder" => $label,
                    "rows" => 10
                ])  !!}

    </div>
    <span class="help-block"><strong id="{{$name}}_error">{{$errors->first($name)}}</strong></span>
</div>