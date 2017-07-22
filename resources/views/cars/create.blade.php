@extends('app')

@section('title', 'Add New Car')

@section('additional_styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}"></link>
@endsection

@section('content')
    <div class="jumbotron">
        <h1>Add New Car</h1>
        <p>In this page, you can add a new car.</p>
    </div>

    <form method="post" action="{{ route('cars.store') }}" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="model" class="col-sm-2 control-label">Model</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="model" name="model" value="{{ old('model') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="registration_number" class="col-sm-2 control-label">Registration Number</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{ old('registration_number') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="year" class="col-sm-2 control-label">Year</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="year" name="year" value="{{ old('year') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="mileage" class="col-sm-2 control-label">Mileage</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mileage" name="mileage" value="{{ old('mileage') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="color" class="col-sm-2 control-label">Color</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="color" name="color" value="{{ old('color') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-sm-2 control-label">Price</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="user_id" class="col-sm-2 control-label">Users</label>
            <div class="col-sm-10">
                <select class="selectpicker" name="user_id" id="user_id">
                    @foreach($users as $user)
                        <option value="{{ $user['id'] }}" >{{ $user['first_name'] . ' ' . $user['last_name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
    @include("partials._messages")
@endsection

@section('additional_scripts')
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
@endsection