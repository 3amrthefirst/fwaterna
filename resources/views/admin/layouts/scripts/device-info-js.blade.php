{{-- get device info --}}
<script>
    function getDeviceInfo(deviceId,deviceInfoEl)
    {
        $.ajax({
            url: "{{url(route('api.device-info'))}}?device_id="+deviceId+"&locale={{app()->getLocale()}}",
            type: 'get',
            success: function (data) {
                if (data.status === 1)
                {
                    deviceInfoEl.html(data.data);
                }else{
                    deviceInfoEl.html("");
                }
            },
            error: function () {
                alert("{{__('حدث خطأ')}}");
            }
        });
    }
    var deviceEl = $("#device_id");
    var deviceInfoEl = $("#device-info");
    deviceEl.change(function () {
        var deviceId = deviceEl.val();
        if (Array.isArray(deviceId))
        {
            deviceId = deviceId[deviceId.length - 1];
        }
        if (deviceId === null || deviceId === "")
        {
            deviceInfoEl.html("");
        }else{
            getDeviceInfo(deviceId,deviceInfoEl);
        }
    });
</script>