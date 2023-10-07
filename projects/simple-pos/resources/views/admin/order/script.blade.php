<script>
    let columns = [{
            mData: 'invoice_code',
            data: 'invoice_code',
            render: function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            mData: 'created_at',
            render: function(data, type, row, meta) {
                return new Date(data).toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }
        },
        {
            data: 'invoice_code',
        },
        {
            mData: 'customer',
            name: 'customer.name',
            render: function(data, type, row, meta) {
                return data ?? '-'
            }
        },
        {
            mData: 'user',
            name: 'user.name',
            render: function(data, type, row, meta) {
                return data ?? '-'
            }
        },
        {
            mData: 'amount',
            render: function(data, type, row, meta) {
                return rupiah(data);
            }
        },
        {
            mData: 'status',
            render: function(data, type, row, meta) {
                return data == 1 ? `<span class="badge badge-success">Success</span>` :
                    `<span class="badge badge-danger">Canceled</span>`
            }
        },
        {
            mData: 'id',
            render: function(data, type, row, meta) {
                let cancel = row.status == 0 ? '' :
                    `<button class="btn btn-danger btn-sm cancelOrder" data-id="${data}">Cancel</button>`
                return `
                <a class="btn btn-warning btn-sm detailOrder" data-id="${data}">Detail</a>
                ${cancel}`;
            }
        }
    ]

    initDatatable({
        columns: columns,
    });

    $('#table').on('click', '.cancelOrder', function() {
        let konfirmasi = confirm('Are you sure?');
        let id = $(this).data('id');
        let url = CURRENT_URL + '/' + id;
        if (konfirmasi) {
            let id = $(this).data('id');

            $.ajax({
                url: CURRENT_URL + '/' + id,
                type: 'PUT',
                data: {
                    _token: CSRF_TOKEN,
                    _method: 'PUT',
                    status: 0
                },
                success: function(data) {
                    if (data.status == 'success') {
                        successNotif(data.message);
                        $('#table').DataTable().ajax.reload();
                    } else {
                        errorNotif(data.message);
                    }
                }
            });
        }
    });

    $('#table').on('click', '.detailOrder', function() {
        let id = $(this).data('id');
        $('#id').val(id);
        let url = CURRENT_URL + '/' + id;
        $.ajax({
            url: url,
            type: 'GET',
            success: function(result) {
                if (result.status == 'success') {
                    $('.modal-title').html('Detail Order');
                    let order = '';
                    let detail = '';
                    let subTotal = 0;
                    $.each(result.data.detail, function(index, value) {
                        subTotal += value.stock.selling_price * value.stock.qty;
                        detail += `
                        <tr>
                            <td>${value.stock.product.name}</td>
                            <td>${rupiah(value.stock.selling_price)}</td>
                            <td>${numeric(value.stock.qty)}</td>
                        </tr>
                        `
                    })

                    order += `
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Invoice Code</th>
                                <td>${result.data.invoice_code}</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>${new Date(result.data.created_at).toLocaleDateString('id-ID', {
                                    day: '2-digit',
                                    month: '2-digit',
                                    year: 'numeric',
                                    hour: '2-digit',
                                    minute: '2-digit'
                                })}</td>
                            </tr>
                            <tr>
                                <th>Customer</th>
                                <td>${result.data.customer == null ? 'Guest' : result.data.customer.name}</td>
                            </tr>
                            <tr>
                                <th>Cashier</th>
                                <td>${result.data.user == null ? '-' : result.data.user.name}</td>
                            </tr>
                        </table>
                        <table class="table mt-3 ">
                            <thead class="bg-secondary">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                </tr>

                            </thead>
                            <tbody>
                                ${detail}
                                <tr>
                                    <th colspan="2" class="text-right">Sub Total</th>
                                    <td class="text-right">${rupiah(subTotal)}</td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">Discount</th>
                                    <td class="text-right">${rupiah(result.data.discount)}</td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">Total</th>
                                    <td class="text-right">${rupiah(result.data.amount)}</td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">Paid</th>
                                    <td class="text-right">${rupiah(result.data.paid)}</td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">Change</th>
                                    <td class="text-right">${rupiah(result.data.change)}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>`

                    $('.modal-body').html(order);
                    $('#modal-order').modal('show');

                } else {
                    errorNotif(result.data.message);
                }
            }
        });
    });

    $('#modal-order').on('click', '.print', function() {
        let id = $('#id').val();
        let url = CURRENT_URL + '/' + id + '/print';
        window.open(url, '_self');
    });
</script>
