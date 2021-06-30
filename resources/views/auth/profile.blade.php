@extends('layouts/admin-layout')

@section('title', 'Profil Pribadi')

@push('css')
    <style>
        .image {
            width: 200px;
            height: 200px;
            overflow: hidden;
        }
        .image img {
            object-fit: cover;
            width: 200px;
            height: 200px;
        }
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Profile Saya</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Dashboard') }}">The Praktikum</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil Pribadi</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            {{-- <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center mb-3">
                            <div class="image mx-auto d-block rounded">
                                <img class="profile-user-img img-fluid img-circle mx-auto d-block" src="" alt="profile_pribadi" width="150" height="150">
                            </div>
                        </div>
                        <a data-bs-toggle="modal" data-bs-target="#changeProfileImg" class="btn btn-sm btn-outline-primary btn-block">
                            Ganti Foto Profil
                        </a>
                        @include('admin.auth.profile.change-profile-img')
                    </div>
                </div>
            </div> --}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2 d-flex justify-content-center justify-content-lg-start justify-content-sm-start">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" id="tabAccount" href="#account" data-toggle="tab">Akun</a></li>
                            <li class="nav-item"><a class="nav-link" id="tabPersonal" href="#personal" data-toggle="tab">Data Pribadi</a></li>
                            <li class="nav-item"><a class="nav-link" id="tabRole" href="#role" data-toggle="tab">Jabatan</a></li>
                            <li class="nav-item"><a class="nav-link" id="tabPassword" href="#password" data-toggle="tab">Password</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="account">
                                <form action="{{ route('Update Profile', auth()->guard()->user()->detailLogin->id) }}" method="POST" class="form-horizontal needs-validation" novalidate>
                                    @csrf
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-12 col-md-2 col-form-label">Username</label>
                                        <div class="col-sm-12 col-md-10 my-auto">
                                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Masukan username" value="{{ old('username', Auth::guard()->user()->username) }}" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nomor_telepon" class="col-sm-12 col-md-2 col-form-label">Nomor Telp</label>
                                        <div class="col-sm-12 col-md-10 my-auto">
                                            <input name="nomor_telepon" type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" placeholder="Nomor telepon" value="{{ old('nomor_telepon', Auth::guard()->user()->detailLogin->nomor_telepon) }}" autocomplete="off">
                                            @error('nomor_telepon')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="username_telegram" class="col-sm-12 col-md-2 col-form-label">Telegram</label>
                                        <div class="col-sm-12 col-md-10 my-auto">
                                            <input name="username_telegram" type="text" class="form-control @error('username_telegram') is-invalid @enderror" id="username_telegram" placeholder="Username telegram" value="{{ old('username_telegram', Auth::guard()->user()->detailLogin->username_telegram) }}" autocomplete="off">
                                            @error('username_telegram')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="line_id" class="col-sm-12 col-md-2 col-form-label">ID Line</label>
                                        <div class="col-sm-12 col-md-10 my-auto">
                                            <input name="line_id" type="text" class="form-control @error('line_id') is-invalid @enderror" id="line_id" placeholder="Username telegram" value="{{ old('line_id', Auth::guard()->user()->detailLogin->line_id) }}" autocomplete="off">
                                            @error('line_id')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 d-grid">
                                            <button type="submit" class="btn btn-sm btn-outline-success my-1">Simpan Data Akun</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="personal">
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-12 col-md-2 col-form-label">Nama</label>
                                    <div class="col-sm-12 col-md-10 my-auto">
                                        <div class="form-control">
                                            {{ Auth::guard()->user()->detailLogin->nama ?? 'Belum ditambahkan'}}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nim" class="col-sm-12 col-md-2 col-form-label">NIM</label>
                                    <div class="col-sm-12 col-md-10 my-auto">
                                        <div class="form-control">
                                            {{ Auth::guard()->user()->detailLogin->nim ?? 'Belum ditambahkan' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="angkatan" class="col-sm-12 col-md-2 col-form-label">Angkatan</label>
                                    <div class="col-sm-12 col-md-10 my-auto">
                                        <div class="form-control">
                                            {{ Auth::guard()->user()->detailLogin->angkatan ?? 'Belum ditambahkan' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="role">
                                <div class="form-group row">
                                    <label for="jabatan" class="col-sm-12 col-md-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-12 col-md-10 my-auto">
                                        <div class="form-control">
                                            {{ Auth::guard()->user()->jabatan }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-sm-12 col-md-2 col-form-label">Role</label>
                                    <div class="col-sm-12 col-md-10 my-auto">
                                        <div class="form-control">
                                            @foreach ($detail_role as $data)
                                                {{$data->role->nama_role}}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row my-auto">
                                    <label for="terdaftar" class="col-sm-12 col-md-2 col-form-label">Terdaftar Sejak</label>
                                    <div class="col-sm-12 col-md-10">
                                        <div class="form-control">
                                            {{ date('d M Y', strtotime(Auth::guard()->user()->detailLogin->created_at)) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="password">
                                <form action="{{ route('Change Password', auth()->guard()->user()->id) }}" class="form-horizontal needs-validation" method="POST" novalidate>
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputPasswordLama" class="col-sm-12 col-md-3 col-form-label">Password Lama<span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                            <div class="input-group">
                                                <input type="password" name="password_lama" autocomplete="off" class="form-control @error('password_lama') is-invalid @enderror" id="inputPasswordLama" placeholder="Password lama" autocomplete="off" required>
                                                <span class="input-group-text" style="cursor: pointer" onclick="oldPasswordVisibility()"><i class="fas fa-eye-slash" id="oldPassIcon"></i></span>
                                                @error('password_lama')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="invalid-feedback">
                                                        Password lama wajib diisi
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-12 col-md-3 col-form-label">Password Baru<span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                            <div class="input-group">
                                                <input type="password" name="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" id="inputPassword" placeholder="Password baru" autocomplete="off" required>
                                                <span class="input-group-text" style="cursor: pointer" onclick="newPasswordVisibility()"><i class="fas fa-eye-slash" id="newPassIcon"></i></span>
                                                @error('password')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="invalid-feedback">
                                                        Password baru wajib diisi
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-0 mb-0">
                                        <label for="inputPasswordConfirmation" class="col-sm-12 col-md-3 col-form-label">Konfirmasi Password<span class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-9">
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation" autocomplete="off" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" id="inputPasswordConfirmation" placeholder="Konfirmasi password baru" autocomplete="off" required>
                                                <span class="input-group-text" style="cursor: pointer" onclick="confirmPasswordVisibility()"><i class="fas fa-eye-slash" id="confirmPassIcon"></i></span>
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="invalid-feedback">
                                                        Konfirmasi password baru wajib diisi
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right mb-2 mt-3">
                                        <span class="text-danger">* Data Wajib diisi</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-end d-grid">
                                            <button id="test" type="submit" class="btn btn-sm btn-outline-success my-1">Simpan Password</button>
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
@endsection

@push('js')
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif

    @if($message = Session::get('error'))
        <script>
            $(document).ready(function(){
                alertError('{{$message}}');
            });
        </script>
    @endif

    @if($message = Session::get('failed'))
        <script>
            $(document).ready(function(){
                alertDanger('{{$message}}');
            });
        </script>
    @endif

    @if ($errors->has('password_lama') || $errors->has('password'))
        <script>
                $('#tabAccount').removeClass('active');
                $('#account').removeClass('active');
                $('#tabPassword').addClass('active');
                $('#password').addClass('active');
        </script>
    @endif

    <script>
        $(document).ready(function(){
            $('#admin-authentication').addClass('menu-is-opening menu-open');
            $('#authentication').addClass('active');
            $('#admin-profile').addClass('active');
        });

        function oldPasswordVisibility() {
            let toggle = document.getElementById('inputPasswordLama');
            let icon = document.getElementById('oldPassIcon');

            if (toggle.type == 'password') {
                toggle.type = 'text';
                icon.classList.remove('fa-eye-slash')
                icon.classList.add('fa-eye')
            } else {
                toggle.type = 'password';
                icon.classList.remove('fa-eye')
                icon.classList.add('fa-eye-slash')
            }
        }

        function newPasswordVisibility() {
            let toggle = document.getElementById('inputPassword');
            let icon = document.getElementById('newPassIcon');

            if (toggle.type == 'password') {
                toggle.type = 'text';
                icon.classList.remove('fa-eye-slash')
                icon.classList.add('fa-eye')
            } else {
                toggle.type = 'password';
                icon.classList.remove('fa-eye')
                icon.classList.add('fa-eye-slash')
            }
        }

        function confirmPasswordVisibility() {
            let toggle = document.getElementById('inputPasswordConfirmation');
            let icon = document.getElementById('confirmPassIcon');

            if (toggle.type == 'password') {
                toggle.type = 'text';
                icon.classList.remove('fa-eye-slash')
                icon.classList.add('fa-eye')
            } else {
                toggle.type = 'password';
                icon.classList.remove('fa-eye')
                icon.classList.add('fa-eye-slash')
            }
        }
    </script>
@endpush

