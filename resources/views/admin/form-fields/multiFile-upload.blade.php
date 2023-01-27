
<div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
    <label for="{{$name}}">{{$label}}</label>
    <div class="">
        {!! Form::file($name.'[]', [
        "placeholder" => $label,
        "class" => "form-control ".$plugin,
        "multiple" => "multiple",
        "data-preview-file-type" => "text",
        "id" => $name
        ]) !!}
    </div>
    <span class="help-block"><strong id="{{$name}}_error">{{$errors->first($name)}}</strong></span>
</div>
