@extends('layouts.blank')

@section('content')

    <div class="container d-flex flex-column" id="login-page">
        <div class="row align-items-center justify-content-center g-0
        min-vh-100">
            <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
                <!-- Card -->
                <div class="card smooth-shadow-md">
                    <!-- Card body -->
                    <div class="card-body p-6">
                        <div class="mb-4 text-center">
                            <a href="#"><img src="{{asset('assets/images/logo.png')}}" class="mb-2 logo" alt=""></a>
                        </div>
                        <!-- Form -->
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <!-- Username -->
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail:</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha:</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- Checkbox -->
                            <div class="d-lg-flex justify-content-between align-items-center
                  mb-4">
                                <div class="form-check custom-checkbox">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Manter Conectado
                                    </label>
                                </div>

                            </div>
                            <div>
                                <!-- Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        Logar
                                    </button>
                                </div>

                                <div class="d-md-flex justify-content-between mt-4">
                                    <div>
                                        @if (Route::has('password.request'))
                                            <a class="text-inherit" href="{{ route('password.request') }}">
                                                Esqueceu a senha?
                                            </a>
                                        @endif
                                    </div>

                                </div>
                            </div>


                        </form>
                    </div>
                </div>

                <div class="fs-6 text-muted d-flex w-100 justify-content-end pt-4">
                    v1.0.0 - Hookable
                </div>

            </div>
        </div>
    </div>

@endsection
