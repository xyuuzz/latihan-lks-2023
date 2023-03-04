@extends('layouts.app')

@section('content')
<style>
    /* buatkan switch button menggunakan css */
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Jadwal Film terdekat</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            @forelse ($schedule as $item)
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Movie Title: {{$item->movie->name}}</h3>
                                    </div>
                                    <div class="card-body d-lg-flex ">
                                        <img class="img-thumbnail " src="{{asset("storage/pictures_movies/" . $item->movie->picture_url)}}" alt="">
                                        <div class="info" style="margin-left: 30px">
                                            <p>Branch: {{$item->studio->branch->name}}</p>
                                            <p>Studio: {{$item->studio->name}}</p>
                                            <hr>
                                            <p>Start: {{$item->start}}</p>
                                            <p>End: {{$item->end}}</p>
                                            <p>Price: {{$item->price}}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="card">
                                    <div class="card-header">
                                        <h6>Mohon Maaf, tidak ada jadwal film yang akan tayang</h6>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h5>Search Schedule By Branch and Start Date</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{route("user.schedule.search")}}" method="post">
                                        @csrf
                                        <div class="row justify-content-center">
                                            <div class="col-10">
                                                <select name="branch_id" id="branch_id" class="form-control">
                                                    <option value="">-- Select Branch --</option>
                                                    @foreach ($branches as $branch)
                                                        <option @if($branch->id == old("branch_id")) selected @endif value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-10 mt-3">
                                                <label for="date"><small>date schedule movie</small></label>
                                                <input type="date" class="form-control" name="date" id="date">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
