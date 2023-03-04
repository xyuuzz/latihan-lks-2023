@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CRUD Branch</div>

                <div class="card-body">
                    <a href="{{ route('branch.create') }}" class="btn btn-success mb-3">Create Branch</a>

                    <!-- cek apakah ada session success atau error -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Branch Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- loop through the branches table -->
                            @foreach($branches as $branch)
                            <tr>
                                <td>{{ $index++ }}</td>
                                <td>{{ $branch->name }}</td>
                                <td>
                                    <!-- create edit and delete button -->
                                    <a href="{{ route('branch.edit', $branch->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('branch.destroy', $branch->id) }}" method="POST">
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
