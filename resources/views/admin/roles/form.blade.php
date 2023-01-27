{!! \App\MyHelper\Field::text('name' , __('اسم الصلاحية') )!!}
{{--{!! \App\MyHelper\Field::text('display_name' , __('الاسم المعروض') ) !!}--}}
{!! \App\MyHelper\Field::textarea('description' , __('الوصف') ) !!}
<br>
<div class="form-group" id="permissions_wrap">
    <h2>
        <label for="permissions">{{ __('الصلاحيات') }}</label>
        <input type="checkbox" id="selectAll">
        <label style="font-size: 15px; font-weight: 100" for="selectAll">{{ __('تحديد الكل') }}</label>
    </h2>

    <div class="">
        <div class="clearfix"></div>
        @inject('permissionModel','Spatie\Permission\Models\Permission')
        @foreach( $permissions as $type)
            <h2>
                <label>{{ __($type->group) }}</label>
                <input type="checkbox" class="selectSameGroup" id="{{ str_replace(' ', '_', __($type->group)) }}">
                <label style="font-size: 15px; font-weight: 100" for="{{ str_replace(' ', '_', __($type->group)) }}">{{ __('تحديد الكل') }}</label>
            </h2>
            @foreach($permissionModel->where('group',$type->group)->get() as $item)
                <div class="form-group col-md-3" id="permissions_wrap">
                    <div class="">
                        {!! Form::checkBox('permissions[]',$item->id,$model->hasPermissionTo($item) ? true : false,['class' => str_replace(' ', '_', __($type->group))]) !!}
                        <label for="{{$item->name}}">{{ __($item->name) }}</label>
                    </div>
                </div>
                @if($loop->last)
                    <div class="clearfix"></div>
                    <hr>
                @endif
            @endforeach


        @endforeach
    </div>

    <div class="clearfix"></div>

</div>
<br>
<br>

@push('scripts')
    <script>
        $("#selectAll").click(function () {
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
        });

        $(".selectSameGroup").click(function () {
            let group = $(this).attr('id');
            $('.'+group).prop('checked', $(this).prop('checked'));
        });
    </script>
@endpush
