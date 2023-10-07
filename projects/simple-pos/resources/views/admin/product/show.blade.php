@extends('admin.layouts.app')

@section('content')
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="card-title">Product Information</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>SKU</th>
                            <td class="text-right">{{ $product->sku }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td class="text-right">{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td class="text-right">{{ $product->category }}</td>
                        </tr>
                        <tr>
                            <th>Purchase Price</th>
                            <td class="text-right">{{ rupiah($product->purchase_price) }}</td>
                        </tr>
                        <tr>
                            <th>Selling Price</th>
                            <td class="text-right">{{ rupiah($product->selling_price) }}</td>
                        </tr>
                        <tr>
                            <th>Available Stock</th>
                            <td class="text-right">{{ rupiah($product->stock, '') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#stock-in" role="tab"
                            aria-controls="stock-in" aria-selected="true">Stock In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#stock-out" role="tab" aria-controls="stock-in"
                            aria-selected="true">Stock Out</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade active show" id="stock-in" role="tabpanel" aria-labelledby="stock-in-tab">
                        <div class="table-responsive">
                            <table class="table w-100" id="table-stock-in">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Qty</th>
                                        <th>Purchase Price</th>
                                        <th>Description</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="stock-out" role="tabpanel" aria-labelledby="stock-out-tab">
                        <div class="table-responsive">
                            <table class="table w-100" id="table-stock-out">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Qty</th>
                                        <th>Selling Price</th>
                                        <th>Description</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    @include('admin.plugins.datatable-css')
@endpush

@push('scripts')
    @include('admin.plugins.datatable-js')
    <script>
        const columns = (status) => {
            return [{
                    mData: 'id',
                    render: (data, type, row, meta) => {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    mData: 'created_at',
                    render: (data, type, row, meta) => {
                        // convert date to dd-mm-yyyy hh:mm
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
                    mData: 'qty',
                    render: (data, type, row, meta) => {
                        return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    }
                },
                {
                    mData: 'purchase_price',
                    render: (data, type, row, meta) => {
                        return status == 1 ? rupiah(data) : rupiah(row.selling_price);
                    }
                },
                {
                    data: 'description',
                    name: 'description'
                },
                // {
                //     data: 'action',
                //     name: 'action',
                //     orderable: false,
                //     searchable: false
                // }
            ]
        }

        initDatatable({
            columns: columns(1),
            table: 'table-stock-in',
            url: BASE_URL + '/admin/stock?product={{ $product->id }}&status=1'
        });

        initDatatable({
            columns: columns(2),
            table: 'table-stock-out',
            url: BASE_URL + '/admin/stock?product={{ $product->id }}&status=0'
        });
    </script>
@endpush
