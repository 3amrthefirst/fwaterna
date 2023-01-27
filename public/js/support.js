// toastr.options = {
//     "closeButton": true,
//     "debug": false,
//     "newestOnTop": false,
//     "progressBar": false,
//     "positionClass": "toast-top-center",
//     "preventDuplicates": false,
//     "onclick": null,
//     "showDuration": "300",
//     "hideDuration": "10000",
//     "timeOut": "5000",
//     "extendedTimeOut": "1000",
//     "showEasing": "swing",
//     "hideEasing": "linear",
//     "showMethod": "fadeIn",
//     "hideMethod": "fadeOut",
//     "rtl": false
// };

//datepicker


function myFunction(id) {


    $('#btn_'+id).attr('disabled','disabled');
    $('#btn_'+id).css('width','100px');
    $('#btn_'+id).css('height','41px');
    $('#btn_'+id).text('').append('   <div class="adjust">\n' +
        '               <div class="loader2"></div>\n' +
        '            </div>');

}

function toggle(source , name) {
    checkboxes = document.getElementsByName(name);
    for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = source.checked;
    }
}


$(function () {
    $(".datepicker").datepicker({
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    // yearRange: “c-70:c+10”,
    changeYear: true});

    var calendar = $.calendars.instance('ummalqura','ar');
    $('.datepicker2').calendarsPicker({calendar: calendar,dateFormat:'yyyy-mm-dd'});
   
});

$(document).on('click', '.destroy', function () {
    var route = $(this).data('route');
    var token = $(this).data('token');
    $.confirm({
        icon: 'glyphicon glyphicon-floppy-remove',
        animation: 'rotateX',
        closeAnimation: 'rotateXR',
        title: 'Confirm deletion',
        autoClose: 'cancel|6000',
        text: 'Are you sure you want to delete it?',
        confirmButtonClass: 'btn-outline',
        cancelButtonClass: 'btn-outline',
        confirmButton: 'Yes',
        cancelButton: 'No',
        dialogClass: "modal-danger modal-dialog",
        confirm: function () {
            $.ajax({
                url: route,
                type: 'post',
                data: {_method: 'delete', _token: token},
                dataType: 'json',
                success: function (data) {
                    if (data.status == 0) {
                        //toastr.error(data.msg)
                        swal({
                            title: "خطأ!",
                            text: data.msg,
                            type: "error",
                            confirmButtonText: "Ok"
                        });
                    } else {
                        $("#removable" + data.id).remove();
                        swal({
                            title: "Success",
                            text: data.msg,
                            type: "success",
                            confirmButtonText: "Ok"
                        });
                        //toastr.success(data.msg)
                    }
                }
            });
        },
    });
});

$(document).on('click', '.only-confirm', function (e) {
    e.preventDefault();
    $.confirm({ 
        icon: 'glyphicon glyphicon-floppy-remove',
        animation: 'rotateX',
        closeAnimation: 'rotateXR',
        title: 'Confirm deletion',
        autoClose: 'cancel|6000',
        text: 'Are you sure you want to delete it?',
        confirmButtonClass: 'btn-outline',
        cancelButtonClass: 'btn-outline',
        confirmButton: 'Yes',
        cancelButton: 'No',
        dialogClass: "modal-danger modal-dialog",
        confirm: function () {
            $(".only-confirm").parent('form').submit();
        },
    });
});

var document_status = $("#document_status").val();
if (document_status == "1") {
    $("#replayshow").show();
} else {
    $("#replayshow").hide();
}

$("#document_status").change(function () {

    document_status = $("#document_status").val();
    if (document_status == "1") {
        $("#replayshow").show();
    } else {
        $("#replayshow").hide();
    }
});

$('.select2').select2({
    dir: "rtl"
});


// initialize with defaults
$(".file_upload_preview").fileinput({
    showUpload: false,
    showRemove: false,
    showCaption: false
});

// full calendar




 // start system calendar

full_calendar = $('#full-calendar').fullCalendar({
    /*height: 650,*/
    displayEventTime: false,
    header: {
        left: 'prev,next today',
        center: 'title',
        //right: 'month,agendaWeek,agendaDay',
        right: 'month,agendaWeek,agendaDay',
    },
    dayNamesShort: ['الأحد', 'الأثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
    monthNames: ['يناير', 'فبراير', 'مارس', 'إبريل', 'مايو', 'يونيو', 'يوليو', 'اغسطس', 'سبتمبر', 'اكتوبر', 'فبراير', 'ديسمبر'],
    selectable: true,
    selectHelper: true,
    select: function (start, end, allDay) {
        bootbox.prompt("Event name?", function (result) {
            if (result === null) {

            } else {

                full_calendar.fullCalendar('renderEvent',
                    {
                        title: result,
                        start: start,
                        end: end,
                    },
                    true // make the event "stick"
                );
            }
            full_calendar.fullCalendar('unselect');
        });
    },
    editable: false,
    events: "http://localhost/enjz/dates",




    // eventDragStart: eventDragStart,
    /*events: "json-events.php",*/
    loading: function (bool) {
        if (bool) $('#loading').show();
        else $('#loading').hide();
    }


});

// end calender


// start  prince calendar

prince_full_calendar = $('#prince-full-calendar').fullCalendar({
    /*height: 650,*/
    displayEventTime: false,
    header: {
        left: 'prev,next today',
        center: 'title',
        //right: 'month,agendaWeek,agendaDay',
        right: 'month,agendaWeek,agendaDay',
    },
    dayNamesShort: ['الأحد', 'الأثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
    monthNames: ['يناير', 'فبراير', 'مارس', 'إبريل', 'مايو', 'يونيو', 'يوليو', 'اغسطس', 'سبتمبر', 'اكتوبر', 'فبراير', 'ديسمبر'],
    selectable: true,
    selectHelper: true,
    select: function (start, end, allDay) {
        bootbox.prompt("Event name?", function (result) {
            if (result === null) {

            } else {

                prince_full_calendar.fullCalendar('renderEvent',
                    {
                        title: result,
                        start: start,
                        end: end,
                    },
                    true // make the event "stick"
                );
            }
            prince_full_calendar.fullCalendar('unselect');
        });
    },
    editable: false,
    events: "http://localhost/enjz/prince-dates",




    // eventDragStart: eventDragStart,
    /*events: "json-events.php",*/
    loading: function (bool) {
        if (bool) $('#loading').show();
        else $('#loading').hide();
    }


});

// end calender



$("#new_phone").click(function () {
    var tempField = $("#main_phone").clone().find(".phone_values").val("").end();
    // tempField.closest(".phone_values").empty();
    $("#phones_box").append(tempField);
    return false;
});

$("#new_email").click(function () {
    var $tempField = $("#main_email").clone().find(".email_values").val("").end();
    $("#emails_box").append($tempField);
    return false;
});


$("#new_address").click(function () {
    var tempField = $("#main_address").clone().find(".address_values").val("").end();
    $("#addresses_box").append(tempField);
});

function deleteDynamicPhone(anchor) {
    anchor.closest('.row').remove();
}

function deleteDynamicEmail(anchor) {
    anchor.closest('.row').remove();
}

function deleteDynamicAddress(anchor) {
    anchor.closest('.row').remove();
}

function loadComposeModal() {
    $("#composeModal").modal('show');
}


function collectDate(field) {
    var fieldId = field.id;
    var DateField = $("#"+fieldId);
    var DatePickerYear = $("#"+fieldId+"-year").val();
    var DatePickerMonth = $("#"+fieldId+"-month").val();
    var DatePickerDay = $("#"+fieldId+"-day").val();
    DateField.val(DatePickerYear.toString() + '-' + DatePickerMonth.toString() + '-' + DatePickerDay.toString());
}

flyNasDate.forEach(splitFlyNasDate);

function splitFlyNasDate(item , index) {
    var value = $("#"+item).val();
    var spiltedValues = value.split('-');
    $("#"+item+"-year").val(parseInt(spiltedValues[0]));
    $("#"+item+"-month").val(parseInt(spiltedValues[1]));
    $("#"+item+"-day").val(parseInt(spiltedValues[2]));
}
