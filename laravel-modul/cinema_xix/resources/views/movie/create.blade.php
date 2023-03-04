@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@if(isset($movie)) Edit @else Add @endif Movie Page</div>
                <div class="card-body">
                    <!-- buatkan form untuk create movie -->
                    <form action="{{ isset($movie) ? route('movie.update', $movie->id) : route('movie.store') }}" method="POST" enctype="multipart/form-data">
                        @if(isset($movie))
                        @method("PUT")
                        @endif
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Movie Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($movie) ? $movie?->name : old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="minute_length" class="col-md-4 col-form-label text-md-end">{{ __('Minute Length') }}</label>

                            <div class="col-md-6">
                                <input id="minute_length" type="number" class="form-control @error('minute_length') is-invalid @enderror" name="minute_length" value="{{ isset($movie) ? $movie->minute_length : old('minute_length') }}" required>

                                @error('minute_length')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="picture_url" class="col-md-4 col-form-label text-md-end">{{ __('Thumbnail for this movie') }}</label>

                            <div class="col-md-6">
                                <input id="picture_url" type="file" class="form-control @error('picture_url') is-invalid @enderror" name="picture_url" value="{{ old('picture_url') }}" @if(!isset($movie)) required @endisset>

                                @error('picture_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4" style="margin-left: 100px;">
                                <p>Image: </p>
                                <img class="" src="{{ asset("storage/pictures_movies/" . $movie->picture_url) }}" alt="thumbnail movie" height="200">
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
@endsection
