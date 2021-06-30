@extends('layouts/admin-layout')

@section('title', 'Edit Account')

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
        <h1 class="h3 col-lg-auto text-center text-md-start">Manajemen Akun</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Account Data') }}">Daftar Akun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit akun</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header my-auto">
                        <p class="my-auto">Edit Data Akun</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Update Account', $login->id) }}" method="POST" class="form-horizontal needs-validation" novalidate>
                            @csrf
                            <div class="form-group row">
                                <label for="nama" class="col-sm-12 col-md-2 col-form-label">Nama</label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama lengkap" value="{{ old('nama', $login->detailLogin->nama) }}" autocomplete="off" required>
                                    @error('nama')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="invalid-feedback">
                                            Nama lengkap wajib diisi
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-12 col-md-2 col-form-label">Username</label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <div class="form-control">
                                        {{ $login->username ?? 'Belum ditambahkan' }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nim" class="col-sm-12 col-md-2 col-form-label">NIM</label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <input name="nim" type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" placeholder="Nomor Induk Mahasiswa" value="{{ old('nim', $login->detailLogin->nim) }}" autocomplete="off" required>
                                    @error('nim')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="invalid-feedback">
                                            Nomor Induk Mahasiswa wajib diisi
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="angkatan" class="col-sm-12 col-md-2 col-form-label">Angkatan</label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <div class="form-control">
                                        {{ $login->detailLogin->angkatan ?? 'Belum ditambahkan' }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nomor_telepon" class="col-sm-12 col-md-2 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <div class="form-control">
                                        {{ $login->detailLogin->nomor_telepon ?? 'Belum ditambahkan' }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username_telegram" class="col-sm-12 col-md-2 col-form-label">Telegram</label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <div class="form-control">
                                        {{ $login->detailLogin->username_telegram ?? 'Belum ditambahkan' }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="line_id" class="col-sm-12 col-md-2 col-form-label">ID Line</label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <div class="form-control">
                                        {{ $login->detailLogin->line_id ?? 'Belum ditambahkan' }}
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
                                        {{ date('d M Y', strtotime($login->detailLogin->created_at)) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-sm-12 d-grid">
                                    <button type="submit" class="btn btn-sm btn-outline-success my-1">Simpan Pembaharuan Data</button>
                                </div>
                            </div>
                        </form>
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
    
    <script>
        $(document).ready(function(){
            $('#account-management').addClass('menu-is-opening menu-open');
            $('#account-management-link').addClass('active');
            $('#account-data').addClass('active');
        });
    </script>
@endpush