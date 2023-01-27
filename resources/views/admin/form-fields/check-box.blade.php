
<div class="form-group {{$errors->has($name) ? 'has-error':'' }}" id="{{$name}}_wrap">
    <label for="{{$name}}">{{$label}}</label>
    <div class="row">
        @foreach($options as $name => $value)
            <div class="col-lg-3">

                {!! Form::checkbox($name,$value , $value) !!}

                <label for="{{$name}}">{{$name}}</label>
            </div>
        @endforeach
    </div>

    <span class="help-block"><strong id="{{$name}}_error">{{$errors->first($name)}}</strong></span>
</div>