@extends('layouts/admin-layout')

@section('title', 'Additional Data | Tambah Dosen')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h3 class="col-lg-auto text-center text-md-start my-auto">Additional Data</h3>
        <div class="col-auto ml-auto text-right mt-n1 my-auto">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('All Lecture') }}">Data Dosen</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah baru</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header my-auto">
                        <p class="my-auto">Form Tambah Dosen</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Save Lecture') }}" method="POST" class="form-horizontal needs-validation" novalidate>
                            @csrf
                            <div class="form-group row">
                                <label for="nama" class="col-sm-12 col-md-2 col-form-label">Nama<span class="text-danger">*</span></label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukan nama dosen" value="{{ old('nama') }}" autocomplete="off" required>
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
                                <label for="email" class="col-sm-12 col-md-2 col-form-label">Email<span class="text-danger">*</span></label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukan email valid" value="{{ old('email') }}" autocomplete="off" required>
                                    @error('email')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="invalid-feedback">
                                            Email wajib diisi
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nomor_telepon" class="col-sm-12 col-md-2 col-form-label">Nomor Telepon<span class="text-danger">*</span></label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <input name="nomor_telepon" type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" placeholder="Masukan nomor telepon" value="{{ old('nomor_telepon') }}" autocomplete="off" required>
                                    @error('nomor_telepon')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="invalid-feedback">
                                            Nomor telepon wajib diisi
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
                            <div class="form-group my-2 text-end">
                                <span class="text-danger">* Data Wajib Diisi</span>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-sm-12 d-grid">
                                    <button type="submit" class="btn btn-sm btn-outline-success my-1">Tambah Data</button>
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
            $('#additional-data').addClass('menu-is-opening menu-open');
            $('#additional-data-link').addClass('active');
            $('#lecture-data').addClass('active');
        });
    </script>
@endpush

