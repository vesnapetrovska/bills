@extends('partials.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    <br>
                                      <!-- <div class="g-recaptcha" data-sitekey="6LdVkXUUAAAAAOlDwyT6G-qWUglyL1pv0wlZv8mi"></div> -->
                                </div>

                            </div>

                              <span>Generate your key pair:</span>
                              <br>
                              <code>openssl genrsa –aes256 –out private/name.key.pem 2048</code>
                              <br>
                              <span>Download the CSR conf file:</span>
                              <a href="{{asset('csr_openssl.cnf')}}"> Download conf file</a>
                              <span>Create your CSR using the conf file and sign it with your private key</span>
                              <br>
                              <code>openssl req –config csr_openssl.cnf –key private/name.key.pem –new –sha256 –out csr/name.csr.pem</code>
                            <div class="form-group row">
                                <label for="certificate_request" class="col-md-4 col-form-label text-md-right">{{ __('Upload certificate request') }}</label>

                                <div class="col-md-6">
                                    <input id="certificate_request" type="file" class="form-control-sm" name="certificate_request" required>
                                    <!-- <br> -->
                                      <!-- <div class="g-recaptcha" data-sitekey="6LdVkXUUAAAAAOlDwyT6G-qWUglyL1pv0wlZv8mi"></div> -->
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                </div>
                              <div class="col-md-6">
                                    <div class="g-recaptcha" data-sitekey="6LdVkXUUAAAAAOlDwyT6G-qWUglyL1pv0wlZv8mi"></div>
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
