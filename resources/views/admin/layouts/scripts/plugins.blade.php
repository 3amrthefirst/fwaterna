<style>
    .swal2-popup {
        font-size: 1.5rem !important;
    }
</style>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(function() {
        $("span.pie").peity("pie", {
            fill: ['#1ab394', '#d7d7d7', '#ffffff']
        });

        $(".line").peity("line",{
            fill: '#1ab394',
            stroke:'#169c81'
        });

        $(".bar").peity("bar", {
            fill: ["#1ab394", "#d7d7d7"]
        });

        $(".bar_dashboard").peity("bar", {
            fill: ["#1ab394", "#d7d7d7"],
            width:100
        });

        var updatingChart = $(".updating-chart").peity("line", { fill: '#1ab394',stroke:'#169c81', width: 64 })

        setInterval(function() {
            var random = Math.round(Math.random() * 10);
            var values = updatingChart.text().split(",");
            values.shift();
            values.push(random);

            updatingChart
                .text(values.join(","))
                .change()
        }, 1000);

    });
    // Do this before you initialize any of your modals
    {{--$.fn.modal.Constructor.prototype.enforceFocus = function() {};--}}
    {{--$('.select2').select2({--}}
        {{--dir: "{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}"--}}
    {{--});--}}

    @if( session()->get('success'))

    swal({
        title: "{{__('تم')}}",
        text: '{{session('success')}}',
        type: "success",
        showConfirmButton: false,
        timer: 2000
    });


    @elseif(session()->get('error'))

    swal({
        title: "{{__('حدث خطأ')}}",
        text: '{{session('error')}}',
        type: "error",
        showConfirmButton: false,
        timer: 2000
    });

    @endif

    $("#print-all").click(function () {
        window.print();
    });

    /**
     * summer note
     **/
    var $document;
    $(document).ready(function () {
        $('.summernote').summernote();
    });

    $('.datetimepicker').datetimepicker();
    // initialize with defaults
    $(".file_upload_preview").fileinput({
        showUpload: false,
        showRemove: false,
        showCaption: false
    });
    function toggleV2(source , name) {
        checkboxes = document.getElementsByName(name+'[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
    
    // hijri datepicker
    // (function($) {
    //     $.calendars.calendars.ummalqura.prototype.regionalOptions['ar'] = {
    //         name: 'Islamic',
    //         epochs: ['BAM', 'AM'],
    //         monthNames: ['محرّم', 'صفر', 'ربيع الأول', 'ربيع الآخر أو ربيع الثاني', 'جمادى الاول', 'جمادى الآخر أو جمادى الثاني',
    //             'رجب', 'شعبان', 'رمضان', 'شوّال', 'ذو القعدة', 'ذو الحجة'],
    //         monthNamesShort: ['محرّم', 'صفر', 'ربيع الأول', 'ربيع الآخر أو ربيع الثاني', 'جمادى الاول', 'جمادى الآخر أو جمادى الثاني',
    //             'رجب', 'شعبان', 'رمضان', 'شوّال', 'ذو القعدة', 'ذو الحجة'],
    //         dayNames: ['اح', 'اث', 'ث', 'ار', 'خ', 'ج', 'س'],
    //         dayNamesShort: ['اح', 'اث', 'ث', 'ار', 'خ', 'ج', 'س'],
    //         dayNamesMin: ['اح', 'اث', 'ث', 'ار', 'خ', 'ج', 'س'],
    //         digits: $.calendars.substituteDigits(['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩']),
    //         dateFormat: 'yyyy-mm-dd',
    //         firstDay: 6,
    //         isRTL: true,
    //     };
    // })(jQuery);
    // $(function() {

    //     var calendar = $.calendars.instance('ummalqura','ar');

    //     $('.hijri-datepicker').calendarsPicker({
    //         calendar: calendar,
    //         onSelect : function(date) {
    //             var hijriId = this.id;
    //             var georgianId = hijriId.replace("hijri_","");
    //             var selectHijriDate = date[0];
    //             convertToGeorgian(selectHijriDate.toString(),georgianId);
    //         }
    //     });
    // });


    // $('.datepicker').datepicker({
    //     dateFormat: 'yy-mm-dd',
    //     changeMonth: true,
    //     // yearRange: “c-70:c+10”,
    //     changeYear: true,
    //     onSelect: function(dateSelected) {
    //         console.log(this.id+"should update hijri_"+this.id);
    //         var georgianId = this.id;
    //         var hijriId = "hijri_"+georgianId;
    //         convertToHijri(dateSelected.toString(),hijriId);
    //     }
    // });


    // function convertToGeorgian(hijriDate,id)
    // {
    //     $.ajax({
    //         url: window.laravelUrl+"/api/v1/hijri-to-georgian",
    //         type: 'get',
    //         data: {hijri_date:hijriDate},
    //         dataType: 'json',
    //         success: function (data) {
    //             if (data.status === 0) {

    //             } else {
    //                 $("#"+id).val(data.data);
    //             }
    //         }
    //     });
    // }

    // function convertToHijri(georgianDate,id)
    // {
    //     $.ajax({
    //         url: window.laravelUrl+"/api/v1/georgian-to-hijri",
    //         type: 'get',
    //         data: {georgian_date:georgianDate},
    //         dataType: 'json',
    //         success: function (data) {
    //             if (data.status === 0) {

    //             } else {
    //                 $("#"+id).val(data.data);
    //             }
    //         }
    //     });
    // }

    $('.selectize').selectize({

    });
    $('.select2').selectize({

    });

    // $('select').selectize();

    $(document).on('click', '#reset_form', function (e) {
        e.preventDefault();
        $(document).find('form').trigger('reset');
        // $(document).find('select').val(null);

        $('.select2').each(function (index,element) {
            var elementObj = $('#'+element.id);
            var $select = elementObj.selectize();
            if ($select[0])
            {
                var control = $select[0].selectize;
                control.clear();
            }

        });
        $('.selectize').each(function (index,element) {
            var elementObj = $('#'+element.id);
            var $select = elementObj.selectize();
            if ($select[0])
            {
                var control = $select[0].selectize;
                control.clear();
            }

        });

    });

</script>
