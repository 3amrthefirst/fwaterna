</div>

<!-- Mainly scripts -->
<script src="{{ asset('inspina/js/jquery-2.1.1.js') }}"></script>
<script src="{{ asset('inspina/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('inspina/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('inspina/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<script src="{{ asset('inspina/js/jquery.peity.min.js') }}"></script>

{{-- <script src="{{ asset('inspina/js/toastr.min.js') }}"></script> --}}
<!-- Custom and plugin javascript -->
<script src="{{ asset('inspina/js/inspinia.js') }}"></script>
<script src="{{ asset('inspina/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('inspina/js/plugins/jquery-confirm/jquery.confirm.min.js') }}"></script>
<script src="{{ asset('inspina/js/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('inspina/js/plugins/selectize/selectize.min.js') }}"></script>
<script src="{{ asset('inspina/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('inspina/js/plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ asset('inspina/js/plugins/bootstrap-fileinput/js/fileinput_locale_ar.js') }}"></script>
<script src="{{ asset('inspina/js/plugins/lightbox2/js/lightbox.min.js') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.7.0/switchery.min.js"></script>
<script src="{{ asset('inspina/js/datatables.min.js') }}"></script>
<script src="{{ asset('js/summernote.min.js') }}"></script>
<script src="{{ asset('inspina/plugins/hijri-calender/js/jquery.plugin.js') }}"></script>
<script src="{{ asset('inspina/plugins/hijri-calender/js/jquery.calendars.js') }}"></script>
<script src="{{ asset('inspina/plugins/hijri-calender/js/jquery.calendars.plus.js') }}"></script>
<script src="{{ asset('inspina/plugins/hijri-calender/js/jquery.calendars.picker.js') }}"></script>
<script src="{{ asset('inspina/plugins/hijri-calender/js/jquery.calendars.ummalqura.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
    integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
    crossorigin="anonymous"></script>
<script src="{{ asset('js/MostafaSewidan.js') }}"></script>
@include('admin.layouts.scripts.delete')
@include('admin.layouts.scripts.plugins')
<script>
    /**
     * summer note
     **/
    $(document).ready(function() {
        $('.summernote').summernote({
            fontNames: ['Cairo']
        });
    });
</script>
<script>
    @if( session()->get('success'))

        swal({
            title: "نجحت العملية!",
            text: '{{session('success')}}',
            type: "success",
            showConfirmButton: false,
            timer: 1500
        });

    @elseif(session()->get('error'))

        swal({
            title: "فشلت العملية!",
            text: '{{session('error')}}',
            type: "error",
            confirmButtonText: "حسناً"
        });

    @endif

</script>

@stack('scripts')

</body>

</html>
