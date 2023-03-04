@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CRUD Studio</div>

                <div class="card-body">
                    <a href="{{ route('studio.create') }}" class="btn btn-success mb-3">Create Studio</a>

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
                                <th>Studio Name</th>
                                <th>Basic Price</th>
                                <th>Additional Friday Price</th>
                                <th>Additional Saturday Price</th>
                                <th>Additional Sunday Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- loop through the studios table -->
                            @foreach($studios as $studio)
                            <tr>
                                <td>{{ $index++ }}</td>
                                <td>{{ $studio->name }}</td>
                                <td>{{ $studio->basic_price }}</td>
                                <td>{{ $studio->additional_friday_price }}</td>
                                <td>{{ $studio->additional_saturday_price }}</td>
                                <td>{{ $studio->additional_sunday_price }}</td>
                                <td>
                                    <!-- create edit and delete button -->
                                    <a href="{{ route('studio.edit', $studio->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('studio.destroy', $studio->id) }}" method="POST">
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
