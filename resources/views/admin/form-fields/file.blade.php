<div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
    <label for="{{$name}}">{{$label}}</label>
    <div class="">
        @if($multiFile == false)
            {!! Form::file($name,  [
            "placeholder" => $label,
            "class" => "form-control file_upload_preview",
            "id" => $name,
            "data-preview-file-type" => "text"
            ]) !!}
        @else
            {!! Form::file($name.'[]', [
                "placeholder" => $label,
                "class" => "form-control file_upload_preview",
                "multiple" => "multiple",
                "data-preview-file-type" => "text",
                "id" => $name
        ]) !!}
        @endif
    </div>
    <span class="help-block"><strong id="{{$name}}_error">{{$errors->first($name)}}</strong></span>
</div>

