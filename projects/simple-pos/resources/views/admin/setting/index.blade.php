@extends('admin.layouts.app')

@section('content')
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" id="form-store">
                    @csrf
                    <div class="form-group">
                        <label>Logo</label>

                        <input type="file" name="logo" class="dropify" data-default-file="{{ $setting?->logo }}">
                    </div>
                    <div class="form-group">
                        <label>Favicon</label>

                        <input type="file" name="favicon" class="dropify" data-default-file="{{ $setting?->favicon }}">
                    </div>
                    <div class="form-group">
                        <label>Application Name</label>

                        <input type="text" name="application_name" class="form-control"
                            value="{{ $setting?->application_name }}">
                    </div>
                    <div class="form-group">
                        <label>Store Name</label>

                        <input type="text" name="store_name" class="form-control" value="{{ $setting?->store_name }}">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>

                        <input type="text" name="phone_number" class="form-control"
                            value="{{ $setting?->phone_number }}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>

                        <input type="email" name="email" class="form-control" value="{{ $setting?->email }}">
                    </div>
                    <div class="form-group">
                        <label>Address</label>

                        <textarea name="address" class="form-control">{{ $setting?->address }}</textarea>
                    </div>
                    <button class="btn btn-success" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    @include('admin.plugins.dropify-css')
@endpush

@push('scripts')
    @include('admin.plugins.dropify-js')
    <script>
        $('.dropify').dropify();

        $('#form-store').on('submit', function(e) {
            e.preventDefault();
            setIsValid('#form-store input , #form-store select, #form-store textarea');

            let data = new FormData(this);

            storeData({
                data: data,
                table: null,
                redirect: CURRENT_URL,
            })
        })
    </script>
@endpush
