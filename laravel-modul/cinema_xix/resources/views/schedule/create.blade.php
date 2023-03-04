@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@if(isset($schedule)) Edit @else Create @endif Schedule Page</div>
                <div class="card-body">
                    <form action="{{ isset($schedule) ? route('schedule.update', $schedule->id) : route('schedule.store') }}" method="POST">
                        @if(isset($schedule))
                            @method("PUT")
                        @endif
                        @csrf
                        <div class="row mb-3">
                            <label for="movie_id" class="col-md-4 col-form-label text-md-end">{{ __('Movie') }}</label>

                            <div class="col-md-6">
                                <select name="movie_id" id="movie_id" class="form-control @error('movie_id') is-invalid @enderror">
                                    <option value="">-- Select Movie --</option>
                                    @foreach ($movies as $movie)
                                        <option @if($movie->id == isset($schedule) ? $schedule?->movie_id : null) selected @endif value="{{ $movie->id }}">{{ $movie->name }}</option>
                                    @endforeach
                                </select>

                                @error('movie_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="studio_id" class="col-md-4 col-form-label text-md-end">{{ __('Studio') }}</label>

                            <div class="col-md-6">
                                <select name="studio_id" id="studio_id" class="form-control @error('studio_id') is-invalid @enderror">
                                    <option value="">-- Select Studio --</option>
                                    @foreach ($studios as $studio)
                                        <option @if($studio->id == isset($schedule) ? $schedule?->studio_id : null) selected @endif value="{{ $studio->id }}">{{ $studio->name }}</option>
                                    @endforeach
                                </select>

                                @error('studio_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="start" class="col-md-4 col-form-label text-md-end">{{ __('Start Time') }}</label>

                            <div class="col-md-6">
                                <input id="start" type="datetime-local" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ isset($schedule) ? Carbon\Carbon::parse($schedule->start)->format('Y-m-d H:i') : old('start') }}" required>

                                @error('start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="end" class="col-md-4 col-form-label text-md-end">{{ __('End Time') }}</label>

                            <div class="col-md-6">
                                <input readonly id="end" type="datetime-local" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ isset($schedule) ? Carbon\Carbon::parse($schedule->end)->format('Y-m-d H:i') : old('end') }}" required>

                                @error('end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input readonly id="price" type="number" class="form-control" name="price" value="{{ isset($schedule) ? $schedule->price : old('price') }}" required>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section("script")
    <script>
        $(document).ready(function() {
            $("#start").change(async function() {
                const start = new Date($(this).val())
                // convert start date to format yyyy-mm-dd hh:mm:ss
                const start_date = start.getFullYear() + "-" + (start.getMonth() + 1) + "-" + start.getDate() + " " + start.getHours() + ":" + start.getMinutes() + ":" + start.getSeconds()

                const studio = $("#studio_id").val()
                const movie = $("#movie_id").val()

                const request = $.ajax({
                    url: "{{ route('schedule.get-more-info') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        start: start_date,
                        studio: studio,
                        movie: movie,
                    }
                })

                const response = await request
                const data = await response

                $("#end").val(data.end)
                $("#price").val(data.price)
            })
        })
    </script>
@endsection
@endsection
