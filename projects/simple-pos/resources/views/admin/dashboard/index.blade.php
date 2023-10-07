@extends('admin.layouts.app')

@section('content')
    <div class="col-md-12">
        <form class="card" id="form-filter">
            <div class="card-header">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Month</label>
                        <select name="month" class="select2 form-control" style="width: 100%">
                            <option value="">Month</option>
                            @foreach (allMonths() as $key => $month)
                                <option value="{{ $key + 1 }}">
                                    {{ $month }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Year</label>
                        <select name="year" class="select2 form-control" style="width: 100%">
                            <option value="">Year</option>
                            @foreach (allYears(2023, 5, 5) as $year)
                                <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>&nbsp;</label>
                        <button class="btn btn-primary btn-block" type="submit">Filter</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-12">
        <div class="row" id="widget"></div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Chart Order</h5>
            </div>
            <div class="card-body">
                <canvas id="chartOrder">
                </canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Top 10 Sell Product</h5>
            </div>
            <div class="card-body">
                <canvas id="topSellProduct">
            </div>
        </div>
    </div>
@endsection

@push('styles')
    @include('admin.plugins.select2-css')
@endpush

@push('scripts')
    @include('admin.plugins.select2-js')
    @include('admin.dashboard.script')
@endpush
