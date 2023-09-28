<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <div class="background-image">
    <div class="row min-vh-100 d-flex align-items-center justify-content-center">
        <div class="col-xl-6 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block">
                            <img src="{{ asset('img/logo.png') }}" class="card-img" alt="..." style="width:250px; margin-left:75px; margin-top:10px;">
                            <h1 style="margin-left:50px; font-family: algerian; font-size: 35px;"><center>Sistem Manajemen Pengembangan Aplikasi</center></h1>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4" style="font-family: roboto;">LOGIN</h1>
                                </div>
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $item)
                                            <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('login.cekLogin') }}" method="GET">
                                    @csrf
                                    {{-- <div class="mb-3">
                                        <select class="form-control  @error('role') is-invalid @enderror" style="font-family: roboto;" name="role" value="{{ old('role') }}">
                                            <option value="" disabled selected hidden>Pilih Role</option>
                                            <option value='Supervisor'>Supervisor</option>
                                            <option value='Tim'>Tim</option>
                                            <option value='Client'>Client</option>
                                        </select> --}}
                                        {{-- @error('role')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror --}}
                                    {{-- </div> --}}
                                    <div class="mb-3">
                                        <label for="username" class="form-label" style="font-family: roboto;">Username</label>
                                        <input type="text" value="{{ old('username') }}" name="username" class="form-control @error('username') is-invalid @enderror">
                                        {{-- @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label" style="font-family: roboto;">Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('username') }}">
                                        {{-- @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror --}}
                                    </div>
                                    <div class="mb-3 d-grid">
                                        <button name="submit" type="submit" class="btn btn-primary">Login</button>
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
</body>
<style>
    .background-image{
        background-color: green;
        background-size: cover;
        background-repeat: no-repeat;
        width: 99.2%;
    }
</style>
</html>