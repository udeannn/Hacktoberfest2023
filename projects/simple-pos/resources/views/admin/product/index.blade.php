@extends('admin.layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <button class="btn btn-primary" id="add-stock">Add Stock</button>
                <button class="btn btn-info" id="add">Add</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table w-100" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>SKU</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Purchase Price</th>
                            <th>Selling Price</th>
                            <th>Available Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.product.modal')
@include('admin.product.modal-stock')

@endsection

@push('styles')

{{-- plugin --}}
@include('admin.plugins.datatable-css')
@include('admin.plugins.select2-css')
@include('admin.plugins.dropify-css')

@endpush

@push('scripts')

{{-- plugin --}}
@include('admin.plugins.datatable-js')
@include('admin.plugins.select2-js')
@include('admin.plugins.jquery-mask-js')
@include('admin.plugins.dropify-js')

{{-- script for this page --}}
@include('admin.product.script')

@endpush