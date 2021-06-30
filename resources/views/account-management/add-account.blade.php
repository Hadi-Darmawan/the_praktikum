@extends('layouts/admin-layout')

@section('title', 'Add Account')

@push('css')
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Manajemen Akun</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Account Data') }}">Daftar Akun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah akun</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header my-auto">
                        <p class="my-auto">Form Pendaftaran Akun</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Save Account') }}" method="POST" class="form-horizontal needs-validation" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="form-group row">
                                <label for="nama" class="col-sm-12 col-md-2 col-form-label">Nama</label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukan nama lengkap" value="{{ old('nama') }}" autocomplete="off" required>
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
                                <label for="nim" class="col-sm-12 col-md-2 col-form-label">NIM</label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <input name="nim" type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" placeholder="Masukan Nomor Induk Mahasiswa" value="{{ old('nim') }}" autocomplete="off" required>
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
                                <label for="nomor_telepon" class="col-sm-12 col-md-2 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <input name="nomor_telepon" type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" placeholder="Masukan nomor telepon" value="{{ old('nomor_telepon') }}" autocomplete="off">
                                    @error('nomor_telepon')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username_telegram" class="col-sm-12 col-md-2 col-form-label">Username Telegram</label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <input name="username_telegram" type="text" class="form-control @error('username_telegram') is-invalid @enderror" id="username_telegram" placeholder="Masukan username telegram" value="{{ old('username_telegram') }}" autocomplete="off">
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
                                    <input name="line_id" type="text" class="form-control @error('line_id') is-invalid @enderror" id="line_id" placeholder="Masukan ID Line" value="{{ old('line_id') }}" autocomplete="off">
                                    @error('line_id')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-sm-12 col-md-2 col-form-label">Role</label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <select class="select2 form-control @error('role[]') is-invalid @enderror" multiple="multiple" name="role[]" data-placeholder="Pilih role" required style="width: 100%">
                                        @foreach ($role as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_role }}</option>
                                        @endforeach
                                    </select>
                                    @error('role[]')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="invalid-feedback">
                                            Role wajib dipilih
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-sm-12 d-grid">
                                    <button type="submit" class="btn btn-sm btn-outline-success my-1">Tambah Akun</button>
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
    <script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>

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
            $('#add-account').addClass('active');

            $('.select2').select2({
                placeholder: "Select a state",
                allowClear: true
            })
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
@endpush

