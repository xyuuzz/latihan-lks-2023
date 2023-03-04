@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@if(isset($studio)) Edit @else Create @endif Branch Page</div>
                <div class="card-body">
                    <!-- buatkan form untuk create studio -->
                    <form action="{{ isset($studio) ? route('studio.update', $studio->id) : route('studio.store') }}" method="POST">
                        @if(isset($studio))
                            @method("PUT")
                        @endif
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Studio Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($studio) ? $studio?->name : old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="branch_id" class="col-md-4 col-form-label text-md-end">{{ __('Branch') }}</label>

                            <div class="col-md-6">
                                <select name="branch_id" id="branch_id" class="form-control @error('branch_id') is-invalid @enderror">
                                    <option value="">-- Select Branch --</option>
                                    @foreach ($branches as $branch)
                                        <option @if($branch->id == isset($studio) ? $studio?->branch_id : null) selected @endif value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>

                                @error('branch_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="basic_price" class="col-md-4 col-form-label text-md-end">{{ __('Basic Price') }}</label>

                            <div class="col-md-6">
                                <input id="basic_price" type="number" class="form-control @error('basic_price') is-invalid @enderror" name="basic_price" value="{{ isset($studio) ? trim(str_replace(",", "", explode('.', $studio->basic_price)[1])) : old('name') }}" required>

                                @error('basic_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="additional_friday_price" class="col-md-4 col-form-label text-md-end">{{ __('Additional Friday Price') }}</label>

                            <div class="col-md-6">
                                <input id="additional_friday_price" type="number" class="form-control @error('additional_friday_price') is-invalid @enderror" name="additional_friday_price" value="{{ isset($studio) ? trim(str_replace(",", "", explode('.', $studio->additional_friday_price)[1])) : old('additional_friday_price') }}" required>

                                @error('additional_friday_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="additional_saturday_price" class="col-md-4 col-form-label text-md-end">{{ __('Additional saturday Price') }}</label>

                            <div class="col-md-6">
                                <input id="additional_saturday_price" type="number" class="form-control @error('additional_saturday_price') is-invalid @enderror" name="additional_saturday_price" value="{{ isset($studio) ? trim(str_replace(",", "", explode('.', $studio->additional_saturday_price)[1])) : old('additional_saturday_price') }}" required>

                                @error('additional_saturday_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="additional_sunday_price" class="col-md-4 col-form-label text-md-end">{{ __('Additional Sunday Price') }}</label>

                            <div class="col-md-6">
                                <input id="additional_sunday_price" type="number" class="form-control @error('additional_sunday_price') is-invalid @enderror" name="additional_sunday_price" value="{{ isset($studio) ? trim(str_replace(",", "", explode('.', $studio->additional_sunday_price)[1])) : old('additional_sunday_price') }}" required>

                                @error('additional_sunday_price')
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

<script>
    // find javascript binary search
    
</script>
@endsection
