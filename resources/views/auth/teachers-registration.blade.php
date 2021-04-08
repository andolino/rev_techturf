@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> {{ isset($url) ? ucwords($url) : ""}} {{ __('Register') }}</div>

                <div class="card-body">
                    @isset($url)
                    <form method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Register') }}">
                    @else
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                    @endisset
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="name" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                          <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Lastname') }}</label>

                          <div class="col-md-6">
                              <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="name" autofocus>

                              @error('lastname')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Firstname') }}</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="name" autofocus>

                              @error('firstname')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="middlename" class="col-md-4 col-form-label text-md-right">{{ __('Middlename') }}</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" value="{{ old('middlename') }}" required autocomplete="name" autofocus>

                              @error('middlename')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>


                        <div class="form-group row">
                          <label for="rate_per_hr" class="col-md-4 col-form-label text-md-right">{{ __('Rate Per Hour') }}</label>

                          <div class="col-md-6">
                              <input id="rate_per_hr" type="text" class="form-control @error('rate_per_hr') is-invalid @enderror" name="rate_per_hr" value="{{ old('rate_per_hr') }}" required autocomplete="name" autofocus>

                              @error('rate_per_hr')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="country_id" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                          <div class="col-md-6">
                            <select class="custom-select custom-select-sm" id="country_id" @error('country_id') is-invalid @enderror" name="country_id"  >
                              <option selected hidden></option>
                              @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id') ? "selected" : "" }}>{{ $country->country_name }}</option>
                              @endforeach
                            </select>
                            @error('country_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="objective_title" class="col-md-4 col-form-label text-md-right">{{ __('Objective Title') }}</label>

                            <div class="col-md-6">
                                <input id="objective_title" type="text" class="form-control @error('objective_title') is-invalid @enderror" name="objective_title" value="{{ old('objective_title') }}" required autocomplete="objective_title">

                                @error('objective_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="objective_text" class="col-md-4 col-form-label text-md-right">{{ __('Objective Description') }}</label>

                            <div class="col-md-6">
                                <textarea 
                                  id="objective_text" 
                                  class="form-control @error('objective_text') is-invalid @enderror"
                                  name="objective_text"
                                  required>{{ old('objective_text') }}</textarea>
                                @error('objective_text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
