<script>
    let columns = [{
            mData: 'id',
            render: function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: 'name',
        },
        {
            data: 'phone_number',
        },
        {
            data: 'address',
        },
        {
            mData: 'id',
            render: function(data, type, row, meta) {
                return `<button class="btn btn-info btn-sm editData" data-id="${data}">Edit</button>
                            <button class="btn btn-danger btn-sm deleteData" data-id="${data}">Delete</button>`;
            }
        }
    ]
    initDatatable({
        columns: columns,
    });

    // button add modal
    $('#add').on('click', function() {
        $('#form-store').find('input[name="id"]').val('');
        $('.modal-title').text('Add Customer');
        $('#modal-store').modal('show');
        removeValidations();
    });

    $('#table').on('click', '.editData', function() {
        removeValidations();
        let id = $(this).data('id');
        $.ajax({
            url: CURRENT_URL + '/' + id + '/edit',
            type: "GET",
            success: function(result) {
                $('.modal-title').text('Edit Customer');
                $('#modal-store').modal('show');
                $('#form-store').find('input[name="name"]').val(result.data.name);
                $('#form-store').find('input[name="phone_number"]').val(result.data.phone_number);
                $('#form-store').find('textarea[name="address"]').val(result.data.address);
                $('#form-store').find('input[name="id"]').val(result.data.id);
            }
        })
    });

    $('#table').on('click', '.deleteData', function() {
        let id = $(this).data('id');

        deleteData({
            url: CURRENT_URL + '/' + id,
            table: 'table',
        })
    });

    // submit form
    $('#form-store').on('submit', function(e) {
        e.preventDefault();

        // setIsValid all input, select, textarea
        setIsValid('#form-store input , #form-store select, #form-store textarea');

        let data = new FormData(this);

        storeData({
            data: data,
        })
    });
</script>
