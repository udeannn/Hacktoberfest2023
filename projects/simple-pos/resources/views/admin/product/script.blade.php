<script>
    $(document).ready(function() {
        $('.currencyInput').mask("000.000.000.000", {
            reverse: true,
        });

        $('.numericInput').mask("000.000.000.000", {
            reverse: true,
        });
    })

    let columns = [{
            mData: 'id',
            render: function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            mData: 'photo',
            render: function(data, type, row, meta) {
                let img = data ? BASE_URL + '/storage/product/' + data :
                    "https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=";
                return `<img src="${img}" alt="" width="75">`;
            }
        },
        {
            data: 'sku',
        },
        {
            data: 'name',
        },
        {
            data: 'category',
            searchable: false,
        },
        {
            mData: 'purchase_price',
            render: function(data, type, row, meta) {
                return rupiah(data);
            }
        },
        {
            mData: 'selling_price',
            render: function(data, type, row, meta) {
                return rupiah(data);
            }
        },
        {
            mData: 'stock',
            render: function(data, type, row, meta) {
                // convert to format example 1.000
                return data == 0 ? `<span class="badge badge-danger">Out of Stock</span>` :
                    data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            searchable: false,
        },
        {
            mData: 'id',
            render: function(data, type, row, meta) {
                return `
                <a class="btn btn-warning btn-sm" href="${CURRENT_URL+'/'+data}">Detail</a>
                <button class="btn btn-info btn-sm editData" data-id="${data}">Edit</button>
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
        $('#photo').html(`
            <label>Photo</label>
            <input type="file" name="photo" class="dropify">
        `)
        // reset dropify
        $('.dropify').off('change');
        $('.dropify').dropify();
        $('.modal-title').text('Add Product');
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
                let img = result.data.photo ? BASE_URL + '/storage/product/' + result.data.photo :
                    '';

                $('.modal-title').text('Edit Product');
                $('#modal-store').modal('show');
                $('#photo').html(`
                    <label>Photo</label>
                    <input type="file" name="photo" class="dropify" data-default-file="${img}">
                `)
                // reset dropify
                $('.dropify').dropify();

                $('#form-store').find('input[name="sku"]').val(result.data.sku);
                $('#form-store').find('input[name="name"]').val(result.data.name);
                $('#form-store').find('select[name="category"]').val(result.data.category_id);
                $('#form-store').find('input[name="purchase_price"]').val(result.data
                    .purchase_price).trigger('input');
                $('#form-store').find('input[name="selling_price"]').val(result.data.selling_price)
                    .trigger('input');
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

    // submit form store
    $('#form-store').on('submit', function(e) {
        e.preventDefault();

        // setIsValid all input, select, textarea
        setIsValid('#form-store input , #form-store select, #form-store textarea');

        let data = new FormData(this);

        storeData({
            data: data,
        })
    });

    // add stock
    $('#add-stock').on('click', function() {
        $('.modal-title-stock').text('Add Stock');
        $('#form-stock select[name="product"]').val(null).trigger('change');
        $('#modal-stock').modal('show');
        removeValidations('form-stock');
    });

    // ajax select2
    $('#form-stock select[name="product"]').select2({
        placeholder: 'Select Product',
        theme: 'bootstrap4',
        ajax: {
            url: BASE_URL + '/admin/api/product',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term,
                }
            },
            processResults: function(data, page) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.sku + ' - ' + item.name,
                            id: item.id
                        };
                    })
                };
            },
            cache: true
        }
    });

    // submit form stock
    $('#form-stock').on('submit', function(e) {
        e.preventDefault();

        // setIsValid all input, select, textarea
        setIsValid('#form-stock input , #form-stock select, #form-stock textarea');

        let data = new FormData(this);

        storeData({
            data: data,
            url: BASE_URL + '/admin/stock',
            modal: 'modal-stock',
            form: 'form-stock',
        })
    });
</script>
