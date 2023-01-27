<script>
    $(document).on('click','.destroy',function(){
        var route   = $(this).data('route');
        var token   = $(this).data('token');
        $.confirm({
            icon                : 'glyphicon glyphicon-floppy-remove',
            animation           : 'rotateX',
            closeAnimation      : 'rotateXR',
            title               : '{{__("تأكيد عملية الحذف")}}',
            autoClose           : 'cancel|6000',
            text                : '{{__("هل أنت متأكد من الحذف ؟")}}',
            confirmButtonClass  : 'btn-outline',
            cancelButtonClass   : 'btn-outline',
            confirmButton       : '{{__("نعم")}}',
            cancelButton        : '{{__("لا")}}',
            dialogClass			: "modal-danger modal-dialog",
            confirm: function () {
                $.ajax({
                    url     : route,
                    type    : 'post',
                    data    : {_method: 'delete', _token :token},
                    dataType:'json',
                    success : function(data){
                        if(data.status === 0)
                        {
                            //toastr.error(data.msg)
                            Swal.fire("{{__('حدث خطأ')}}", data.message, "error")
                        }else{
                            $("#removable"+data.id).remove();
                            Swal.fire("{{__('تم')}}", data.message, "success")
                            //toastr.success(data.msg)
                        }
                    }
                });
            },
        });
    });
</script>