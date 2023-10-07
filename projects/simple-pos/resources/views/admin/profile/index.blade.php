@extends('admin.layouts.app')

@section('content')
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" id="form-store">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ getUser()->name }}">
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" value="{{ getUser()->username }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <button class="btn btn-success" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
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
