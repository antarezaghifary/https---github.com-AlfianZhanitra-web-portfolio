<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('home.layouts.meta')
    @include('home.layouts.css')
    @yield('css')
    <title>{{ $pagetitle }} | {{ $profile->nama }}</title>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">
    <!-- TOP NAV -->
    @include('home.layouts.top-nav')
    <!-- BOTTOM NAV -->
    @include('home.layouts.bootom-nav')

    @yield('main')

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="container-fluid">
                        <div class="row gy-4">
                            <div class="col-lg-6 col-sm-12 bg-cover"
                                style="background-image: url(/assets/homepage/img/c2.jpg); min-height:300px;">
                                <div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <form action="{{ url('process-login') }}" method="post" class="p-lg-5 col-12 row g-3">
                                    @csrf
                                    <div>
                                        <h1>Masuk</h1>
                                    </div>
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <div class="col-12">
                                        <label for="nis" class="form-label">NIS</label>
                                        <input type="text" class="form-control @error('nis') is-invalid @enderror"
                                            placeholder="Masukan NIS" name="nis" id="nis">
                                        @if ($errors->has('nis'))
                                            <div class="text-danger">{{ $errors->first('nis') }}
                                            </div>
                                        @endif
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password"
                                            class="form-control @error('passsword') is-invalid @enderror"
                                            placeholder="Masukan Password" name="password" id="password">
                                        @if ($errors->has('password'))
                                            <div class="text-danger">{{ $errors->first('password') }}</div>
                                        @endif
                                        <div class="pt-3">
                                            <button type="submit" class="btn btn-brand">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('home.layouts.footer')

    @include('home.layouts.js')
    @yield('script')
</body>

</html>
