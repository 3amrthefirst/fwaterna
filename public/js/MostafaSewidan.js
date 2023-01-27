function push_element(name) {


    console.log(name);
    var input_value = $("#" + name + "").val();
    var input_type = $("#" + name + "").attr('type');
    console.log(input_value);
    if (input_value === '' || input_value == null) {
        $("#" + name + "").focus();

    } else {
        var uuid = Math.floor((Math.random() * 100) + 1);
        var row_built = '<tr id="removable' + uuid + '">';

        row_built += '<td><div class="form-group"><input class="form-control" name="' + name + '[]" value="' + input_value + '" type="' + input_type + '"></div></td>';
        row_built += '<td class="text-center"><a href="javascript:void(0)" id="' + uuid + '" class="delete-row btn btn-danger"><i class="fa fa-trash"></i></a></td>';
        row_built += '</tr>';
        $("#" + name + "_table_body").append(row_built);
        $("#" + name + "").val("");
    }
}

function toggle(source, name) {
    checkboxes = document.getElementsByName(name + '[]');
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
}

function initSingleSwitchery(elem) {
    var init = new Switchery(elem, {size: 'small'});
}


// js switchery multiple
function initSwichery() {
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html, {size: 'small'});
    });
}

initSwichery();

function toggleBoolean(el, url) {
    var checked = $(el).is(':checked');
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function (data) {
            if (data.status === 0) {
                $(el).prop('checked', !checked);
                $(el).next().remove();
                initSingleSwitchery(el);
                $("#removable" + data.id).remove();
                swal({
                    title: "فشلت العملية!",
                    text: data.massage,
                    type: "error",
                    confirmButtonText: "حسناً"
                });
            }

        }, error: function () {
            $(el).prop('checked', !checked);
            $(el).next().remove();
            initSingleSwitchery(el);
            Swal.fire("خطأ!", "حدث خطأ", "error");
        }
    });
}

$('.table_body').on('click', 'a.delete-row', function (e) {

    console.log(10000);
    e.preventDefault();
    console.log(this.id);
    var elToDel = $("#removable" + this.id);
    console.log(elToDel);
    elToDel.remove();
});

$(document).ready(function () {

    //console.log(1);

});


function contact_read(id) {

    $.ajax({
        url: 'contacts/is-read/' + id,
        type: 'get',
        success: function (data) {

            $('#removable' + id).css('background-color', 'white');
        },
        error: function (data) {

        }
    });
}

function toggleHomeSpinners() {

    $('#sedar-div').toggle();
}


$('#ajaxForm').submit(function (e) {

    e.preventDefault();
    toggleHomeSpinners();
    var form = $('#ajaxForm');
    var url = form.attr('action');
    var form_data = new FormData(this);
    var form_type = form.attr('method');
    var btn = $('#ajax-button');
    var btnSpinner = $('#btn-spinner');

    $(".help-block").hide();
    $(".has-error").removeClass('has-error');

    btn.attr('disabled', 'disabled');
    btnSpinner.show();
    $.ajax({
        url: url,
        type: form_type,
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            var url = data.url;
            if (url) {
                window.location = url;
            }
        },
        error: function (data) {
            var error = data.responseJSON.errors;

            btn.removeAttr('disabled');
            btnSpinner.hide();
            toggleHomeSpinners();

            $.each(error, function (key, value) {
                var targetHelpBlock = $('#' + key + '_error');
                targetHelpBlock.text('').append(value);
                targetHelpBlock.parent().show();
                targetHelpBlock.parent().parent().addClass('has-error');

            });

        }
    });
});