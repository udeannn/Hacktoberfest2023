@extends('admin.layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <button class="btn btn-info" id="add">Add</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table w-100" id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.category.modal')
@endsection

@push('styles')
    @include('admin.plugins.datatable-css')
@endpush

@push('scripts')
    @include('admin.plugins.datatable-js')
    @include('admin.category.script')
@endpush
