@extends('app')

@section('title', 'Cars List')

@section('content')
    <div class="jumbotron">
        <h1>Cars List</h1>
        <p>This page contains the entire list of cars.</p>
    </div>

    @if(count($cars) > 0)
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Model</th>
                <th>Color</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car['id'] }}</td>
                    <td><a href="{{ route('cars.show', $car['id']) }}">{{ $car['model'] }}</a></td>
                    <td>{{ $car['color'] }}</td>
                    <td>{{ $car['price'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-danger" role="alert">
            <strong>Error:</strong>
            <ul>
                <li>No cars</li>
            </ul>
        </div>
    @endif
@endsection