@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CRUD Movie</div>

                <div class="card-body">
                    <a href="{{ route('movie.create') }}" class="btn btn-success mb-3">Create Movie</a>

                    <!-- cek apakah ada session success atau error -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- create table from movie migration -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Movie Name</th>
                                <th>Minute Length</th>
                                <th>Thumbnail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($movies as $movie)
                            <tr>
                                <td>{{ $index++ }}</td>
                                <td>{{ $movie->name }}</td>
                                <td>{{ $movie->minute_length }}</td>
                                <td><img src="{{ asset("storage/pictures_movies/" . $movie->picture_url) }}" alt="thumbnail movie" width="200" height="120"></td>
                                <td>
                                    <!-- create edit and delete button -->
                                    <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('movie.destroy', $movie->id) }}" method="POST">
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
