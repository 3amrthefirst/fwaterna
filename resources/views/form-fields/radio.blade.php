
<div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
    <label for="{{$name}}">{{$label}}</label>
    <div class="row">
        <div class="col-lg-12">
            @foreach($options as $value => $displayName)
                <label class="radio-inline" style="">
                    <input name="{{$name}}" type="radio" value="{{$value}}" {{$checked == $value ? 'checked' : ''}}>

                    <label for="{{$name}}">{{$displayName}}</label>

                </label>
            @endforeach
        </div>
    </div>

    <span class="help-block"><strong id="{{$name}}_error">{{$errors->first($name)}}</strong></span>
</div>
