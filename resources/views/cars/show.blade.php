@extends('app')

@section('title')
    {{ $car['model'] }}
@endsection

@section('content')
    <div class="jumbotron">
        <h1>{{ $car['model'] }}</h1>
        <p>{{ $car['model'] }} info page.</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Registration number</th>
                    <th>Color</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $car['model'] }}</td>
                    <td>{{ $car['year'] }}</td>
                    <td>{{ $car['registration_number'] }}</td>
                    <td>{{ $car['color'] }}</td>
                    <td>{{ $car['price'] }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-4">
            <div class="well">
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="text-align: center"><strong>You may execute these actions</strong></h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @can('edit', App\Entity\Car::class)
                        <div class="col-md-6">
                            <a href="{{ route('cars.edit', $car['id']) }}" class="btn btn-primary btn-block edit-button">Edit</a>
                        </div>
                    @endcan

                    @can('create', App\Entity\Car::class)
                        <div class="col-md-6">
                            <form method="post" action="{{ route('cars.destroy', $car['id']) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-block delete-button">Delete</button>
                            </form>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

@endsection