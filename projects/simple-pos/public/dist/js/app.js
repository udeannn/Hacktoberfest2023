const BASE_URL = $('meta[name="base-url"]').attr('content');
const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).ajaxStop(function () {
    $(".preload").hide()
});


// set header ajax
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': CSRF_TOKEN
    }
});


// remove is-valid and is-invalid class
function removeValidations(form = 'form-store') {
    $('.is-valid').removeClass('is-valid');
    $('.is-invalid').removeClass('is-invalid');
    $('#' + form).trigger('reset');
    $('.invalid-feedback').remove();
}

// set is-valid class
function setIsValid(element) {
    $('.invalid-feedback').remove();
    $(element).addClass('is-valid').removeClass('is-invalid');
}

//set alertify
alertify.set('notifier', 'position', 'top-right');

// success notification sweetalert2
const successNotif = (message) => {
    alertify.success(message).delay(2);
}

// error notification sweetalert2
const errorNotif = (message) => {
    alertify.error(message).delay(2);
}

// current url delete character # and ?
const CURRENT_URL = window.location.href.replace(/#.*$/, '').replace(/\?.*$/, '');

// store data
const storeData = (args) => {
    let defaultParams = {
        url: CURRENT_URL,
        data: {},
        table: 'table',
        modal: 'modal-store',
        form: 'form-store',
        redirect: null,
    };

    let params = Object.assign(defaultParams, args);

    $.ajax({
        url: params.url,
        type: "POST",
        data: params.data,
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        redirect: null,
        beforeSend: function () {
            $(".preload").show()
        },
        success: function (result) {
            successNotif(result.message);
            params.table != null ? $('#' + params.table).DataTable().ajax.reload() : '';
            $('#' + params.modal).modal('hide');
            if (params.redirect != null) {
                setTimeout(() => {
                    window.location = params.redirect
                }, 2000);

            }

        },
        error: function (error) {
            let res = error.responseJSON;

            if (error.status == 422) {
                errorNotif('Please check your input');
                $.each(res.errors, function (key, value) {
                    $('#' + params.form).find('input[name="' + key + '"]').addClass(
                        'is-invalid').removeClass('is-valid').after(
                            '<span class="invalid-feedback">' + value + '</span>');

                    $('#' + params.form).find('textare[name="' + key + '"]').addClass(
                        'is-invalid').removeClass('is-valid').after(
                            '<span class="invalid-feedback">' + value + '</span>');

                    $('#' + params.form).find('select[name="' + key + '"]').addClass(
                        'is-invalid').removeClass('is-valid').after(
                            '<span class="invalid-feedback">' + value + '</span>');
                });
            } else {
                errorNotif(res.message);
            }
        }
    })

}

// delete data
const deleteData = (args) => {
    let defaultParams = {
        url: CURRENT_URL,
        table: 'table',
    };

    let params = Object.assign(defaultParams, args);

    let konfirmasi = confirm(params.message);

    if (konfirmasi) {
        $.ajax({
            url: params.url,
            type: "DELETE",
            beforeSend: function () {
                $(".preload").show()
            },
            success: function (result) {
                successNotif(result.message);
                $('#' + params.table).DataTable().ajax.reload();
            },
            error: function (error) {
                errorNotif(res.message);
            }
        })
    }
}

// init datatable
const initDatatable = (args) => {
    let defaultParams = {
        url: CURRENT_URL,
        table: 'table',
        columns: [],
        order: [],
    };

    let params = Object.assign(defaultParams, args);

    $('#' + params.table).DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: params.url,
            type: 'GET',
        },
        columns: params.columns,
        order: params.order,
        responsive: true,
    });
}

// convert rupiah
const rupiah = (value) => {
    return value ? 'Rp. ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : 'Rp. 0';
}

// convert numeric with dot
const numeric = (value) => {
    return value ? value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '0';
}

const imageUrl = (data) => {
    let img = data ? BASE_URL + '/storage/product/' + data :
        "https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=";
    return img;
}
