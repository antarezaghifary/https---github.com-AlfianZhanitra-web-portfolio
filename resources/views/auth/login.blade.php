@extends('auth.layouts.template')
@section('main')
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">



                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pb-2">
                                        <div class="d-flex align-items-center py-4 flex-column">
                                            <a href="{{ url('') }}" class="d-flex align-items-center w-auto">
                                                <img src="{{ url('assets/admin/img/logo.png') }}" alt=""
                                                    style="height: 80px;">
                                            </a>
                                            <span class="d-lg-block fw-bold">SMP N 4 Cikembar</span>
                                        </div><!-- End Logo -->
                                    </div>
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    @error('login_gagal')
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <span class="alert-inner--text"><strong>Gagal!</strong>
                                                {{ $message }}
                                            </span>
                                        </div>
                                    @enderror
                                    <form action="{{ url('proses_login') }}" method="POST" class="row g-3 needs-validation"
                                        novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control" id="yourUsername"
                                                    required>
                                                @if ($errors->has('username'))
                                                    <div class="invalid-feedback">{{ $errors->first('username') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword"
                                                required>
                                            @if ($errors->has('password'))
                                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>


                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
@endsection
