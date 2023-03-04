@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CRUD Schedule</div>

                <div class="card-body">
                    <a href="{{ route('schedule.create') }}" class="btn btn-success mb-3">Create Schedule</a>

                    <!-- cek apakah ada session success atau error -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- create table from studio migration -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                @foreach($tableHeader as $header) 
                                    <th>{{ $header }}</th>
                                @endforeach
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                            <tr>
                                <td>{{ $index++ }}</td>
                                <td>{{ $schedule->movie->name }}</td>
                                <td>{{ $schedule->studio->name }}</td>
                                <td>{{ $schedule->start }}</td>
                                <td>{{ $schedule->end }}</td>
                                <td>{{ $schedule->price }}</td>
                                <td>
                                    <!-- create edit and delete button -->
                                    <a href="{{ route('schedule.edit', $schedule->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
