@extends('layouts/admin-layout')

@section('title', 'Add Praktikum')

@push('css')
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Praktikum</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('All Praktikum') }}">Praktikum</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah praktikum</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header my-auto">
                        <p class="my-auto">Form Tambah Praktikum</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Save Praktikum') }}" method="POST" class="form-horizontal needs-validation" novalidate>
                            @csrf
                            <div class="form-group row">
                                <label for="role" class="col-sm-12 col-md-2 col-form-label">Jenis Praktikum<span class="text-danger">*</span></label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <select class="select2 form-control @error('jenis_praktikum') is-invalid @enderror" name="jenis_praktikum" data-placeholder="Pilih jenis praktikum" required style="width: 100%">
                                        <option value=""></option>
                                        @foreach ($jenis_praktikum as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_praktikum }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_praktikum')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="invalid-feedback">
                                            Jenis praktikum wajib dipilih
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dosen_pengampu" class="col-sm-12 col-md-2 col-form-label">Dosen Pengampu<span class="text-danger">*</span></label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <select class="select2 form-control @error('dosen_pengampu') is-invalid @enderror" name="dosen_pengampu" id="dosen_pengampu" data-placeholder="Pilih dosen pengampu" required style="width: 100%">
                                        <option value=""></option>
                                        @foreach ($dosen as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('dosen_pengampu')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="invalid-feedback">
                                            Dosen pengampu wajib dipilih
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ketua_praktikum" class="col-sm-12 col-md-2 col-form-label">Ketua Praktikum<span class="text-danger">*</span></label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <select class="select2 form-control @error('ketua_praktikum') is-invalid @enderror" name="ketua_praktikum" id="ketua_praktikum" data-placeholder="Pilih ketua praktikum" required style="width: 100%">
                                        <option value=""></option>
                                        @foreach ($login as $data)
                                            <option value="{{ $data->id }}">{{ $data->detailLogin->nama }}, {{ $data->detailLogin->nim }}</option>
                                        @endforeach
                                    </select>
                                    @error('ketua_praktikum')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="invalid-feedback">
                                            Ketua praktikum wajib dipilih
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tahun" class="col-sm-12 col-md-2 col-form-label">Tahun<span class="text-danger">*</span></label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <input name="tahun" type="text" class="form-control @error('tahun') is-invalid @enderror" id="tahun" placeholder="Masukan tahun praktikum" value="{{ old('tahun') }}" autocomplete="off" required>
                                    @error('tahun')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="invalid-feedback">
                                            Tahun praktikum wajib diisi
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-12 text-end">
                                    <p class="text-danger"><span>*</span> Data Wajib Diisi</p>
                                </div>
                                <div class="col-sm-12 d-grid">
                                    <button type="submit" class="btn btn-sm btn-outline-success my-1">Tambah Praktikum</button>
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
            $('#praktikum-management').addClass('menu-is-opening menu-open');
            $('#praktikum-management-link').addClass('active');
            $('#praktikum').addClass('active');

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

