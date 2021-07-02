@extends('layouts/admin-layout')

@section('title', 'Edit Praktikum')

@push('css')
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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
                    <li class="breadcrumb-item active" aria-current="page">Edit praktikum</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2 d-flex justify-content-center justify-content-lg-start justify-content-sm-start">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" id="tabAsistenPraktikum" href="#dataPraktikum" data-toggle="tab">Data Praktikum</a></li>
                            <li class="nav-item"><a class="nav-link" id="tabPesertaPraktikum" href="#modulPraktikum" data-toggle="tab">Modul Praktikum</a></li>
                        </ul>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content">
                            <div class="tab-pane active" id="dataPraktikum">
                                <div class="card shadow-none border-0 m-0">
                                    <div class="card-body">
                                        <form action="{{ route('Update Praktikum', $praktikum->id) }}" method="POST" class="form-horizontal needs-validation" novalidate>
                                            @csrf
                                            <div class="form-group row">
                                                <label for="role" class="col-sm-12 col-md-2 col-form-label">Jenis Praktikum<span class="text-danger">*</span></label>
                                                <div class="col-sm-12 col-md-10 my-auto">
                                                    <select class="select2 form-control @error('jenis_praktikum') is-invalid @enderror" name="jenis_praktikum" data-placeholder="Pilih jenis praktikum" required style="width: 100%">
                                                        <option value=""></option>
                                                        @foreach ($jenis_praktikum as $data)
                                                            @if ($praktikum->id_jenis_praktikum == $data->id) 
                                                               <option selected value="{{ $data->id }}">{{ $data->nama_praktikum }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('jenis_praktikum')
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
                                            <div class="form-group row">
                                                <label for="dosen_pengampu" class="col-sm-12 col-md-2 col-form-label">Dosen Pengampu<span class="text-danger">*</span></label>
                                                <div class="col-sm-12 col-md-10 my-auto">
                                                    <select class="select2 form-control @error('dosen_pengampu') is-invalid @enderror" name="dosen_pengampu" id="dosen_pengampu" data-placeholder="Pilih dosen pengampu" required style="width: 100%">
                                                        <option value=""></option>
                                                        @foreach ($dosen as $data)
                                                           @if ($data->nama == $praktikum->dosen_pengampu)
                                                               <option selected value="{{ $data->id }}">{{ $data->nama }}</option>
                                                           @endif
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
                                                            @if ($data->detailLogin->nama == $praktikum->ketua_praktikum)
                                                                <option selected value="{{ $data->id }}">{{ $data->detailLogin->nama }}, {{ $data->detailLogin->nim }}</option>
                                                            @endif
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
                                                    <input name="tahun" type="text" class="form-control @error('tahun') is-invalid @enderror" id="tahun" placeholder="Masukan tahun praktikum" value="{{ old('tahun', $praktikum->tahun) }}" autocomplete="off" required>
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
                                                    <button type="submit" class="btn btn-sm btn-outline-success my-1">Simpan Data</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="modulPraktikum">
                                <div class="card shadow-none border-0 m-0">
                                    <div class="card-body">
                                        <form action="{{ route('Upload Modul Praktikum', $praktikum->id) }}" method="POST" class="form-horizontal needs-validation" enctype="multipart/form-data" novalidate>
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 my-auto py-2">
                                                    <div class="form-group my-auto">
                                                        <div class="custom-file">
                                                            <input type="file" name="modul" autocomplete="off" class="custom-file-input @error('modul') is-invalid @enderror" id="fileKTP" autocomplete="off" required>
                                                            <label class="custom-file-label @error('modul') is-invalid @enderror" style="overflow-y: hidden" for="fileKTP">Unggah file modul</label>
                                                            @error('modul')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @else
                                                                <div class="invalid-feedback">
                                                                    File modul praktikum wajib diunggah
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 my-auto">
                                                    <a href="{{ route('Download Modul Praktikum', $modul_praktikum->id) }}" target="_blank" class="btn btn-primary btn-sm my-3">
                                                        <i class="fas fa-download"></i>
                                                        <span class="border-end mx-2"></span>
                                                        Download
                                                    </a>
                                                </div>
                                                <div class="col-6 my-auto text-end">
                                                    <button class="btn btn-success btn-sm my-auto" type="submit">
                                                        <i class="fas fa-upload"></i>
                                                        <span class="border-end mx-2"></span>
                                                        Unggah
                                                    </button>
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
            <div class="col-md-12 mt-3 mb-5">
                <div class="card">
                    <div class="card-header p-2 d-flex justify-content-center justify-content-lg-start justify-content-sm-start">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" id="tabAsistenPraktikum" href="#asistenPraktikum" data-toggle="tab">Asisten Praktikum</a></li>
                            <li class="nav-item"><a class="nav-link" id="tabPesertaPraktikum" href="#pesertaPraktikum" data-toggle="tab">Peserta Praktikum</a></li>
                        </ul>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content">
                            <div class="tab-pane active" id="asistenPraktikum">
                                <div class="card shadow-none border-0 m-0">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6 my-auto">
                                                <h3 class="card-title my-auto">Daftar Asisten Praktikum</h3>
                                            </div>
                                            <div class="col-6 text-end my-auto">
                                                <button class="btn btn-sm btn-primary my-auto" type="button" data-bs-toggle="collapse" data-bs-target="#tambahAsistenPraktikum" aria-expanded="false" aria-controls="tambahAsistenPraktikum">
                                                    <i class="fas fa-user-plus"></i>
                                                    <span class="border-end mx-2"></span>
                                                    Tambah
                                                </button>
                                            </div>
                                        </div>
                                        <div class="collapse my-4" id="tambahAsistenPraktikum">
                                            <div class="card card-body d-flex justify-content-end">
                                                <form action="{{ route('Add Asisten Praktikum', $praktikum->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation my-auto" novalidate>
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-9 col-lg-10 py-2 my-auto">
                                                            <div class="form-group my-auto">
                                                                <div class="my-auto">
                                                                    <select class="select2 form-control form-control-sm @error('asisten_praktikum[]') is-invalid @enderror" name="asisten_praktikum[]" data-placeholder="Pilih asisten praktikum" multiple required style="width: 100%">
                                                                        <option value=""></option>
                                                                        @foreach ($login_asisten as $data)
                                                                            <option value="{{ $data->id }}">{{ $data->detailLogin->nama }}, {{ $data->detailLogin->nim }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('asisten_praktikum[]')
                                                                        <div class="invalid-feedback text-start">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @else
                                                                        <div class="invalid-feedback">
                                                                            Asisten praktikum wajib dipilih
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-3 col-lg-2 my-auto d-grid">
                                                            <button class="btn btn-sm btn-success my-auto">
                                                                <i class="fas fa-save"></i>
                                                                <span class="border-end mx-2"></span>
                                                                Tambah
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="tbAsistenPraktikum" class="table table-responsive-sm table-bordered table-hover">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Telepon</th>
                                                    <th>Line</th>
                                                    <th>Telegram</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($asisten_praktikum as $data)
                                                    <tr class="text-center align-middle my-auto">
                                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                                        <td class="align-middle">{{ $data->login->detailLogin->nama ?? '-' }}</td>
                                                        <td class="align-middle">{{ $data->login->detailLogin->nomor_telepon ?? '-' }}</td>
                                                        <td class="align-middle">{{ $data->login->detailLogin->line_id ?? '-' }}</td>
                                                        <td class="align-middle">{{ $data->login->detailLogin->username_telegram ?? '-' }}</td>
                                                        <td class="text-center align-middle">
                                                            <button onclick="hapusAsistenPraktikum('{{ $data->id }}')" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="pesertaPraktikum">
                                <div class="card shadow-none border-0 m-0">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6 my-auto">
                                                <h3 class="card-title my-auto">Daftar Peserta Praktikum</h3>
                                            </div>
                                            <div class="col-6 text-end my-auto">
                                                <button class="btn btn-sm btn-primary my-auto" type="button" data-bs-toggle="collapse" data-bs-target="#tambahPesertaPraktikum" aria-expanded="false" aria-controls="tambahPesertaPraktikum">
                                                    <i class="fas fa-user-plus"></i>
                                                    <span class="border-end mx-2"></span>
                                                    Tambah
                                                </button>
                                            </div>
                                        </div>
                                        <div class="collapse my-4" id="tambahPesertaPraktikum">
                                            <div class="card card-body d-flex justify-content-end">
                                                <form action="{{ route('Add Anggota Praktikum', $praktikum->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation my-auto" novalidate>
                                                    @csrf
                                                    <div class="form-group form-group-sm row">
                                                        <label for="asisten_praktikum" class="col-sm-12 col-md-2 col-form-label">Asisten Praktikum<span class="text-danger">*</span></label>
                                                        <div class="col-sm-12 col-md-10">
                                                            <select class="select2 form-control @error('asisten_praktikum') is-invalid @enderror" id="asisten_praktikum" name="asisten_praktikum" data-placeholder="Pilih asisten praktikum" required style="width: 100%">
                                                                <option value=""></option>
                                                                @foreach ($asisten_praktikum as $data)
                                                                    <option value="{{ $data->id_login }}">{{ $data->login->detailLogin->nama }}, {{ $data->login->detailLogin->nim }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('asisten_praktikum')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @else
                                                                <div class="invalid-feedback">
                                                                    Asisten praktikum wajib Dipilih
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-group-sm row">
                                                        <label for="peserta_praktikum" class="col-sm-12 col-md-2 col-form-label">Peserta Praktikum<span class="text-danger">*</span></label>
                                                        <div class="col-sm-12 col-md-10">
                                                            <select class="select2 form-control @error('peserta_praktikum[]') is-invalid @enderror" id="peserta_praktikum" name="peserta_praktikum[]" data-placeholder="Pilih peserta praktikum" multiple required style="width: 100%">
                                                                <option value=""></option>
                                                                @foreach ($login_peserta as $data)
                                                                    <option value="{{ $data->id }}">{{ $data->detailLogin->nama }}, {{ $data->detailLogin->nim }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('peserta_praktikum[]')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @else
                                                                <div class="invalid-feedback">
                                                                    Peserta praktikum wajib dipilih
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="kelompok" class="col-sm-12 col-md-2 col-form-label">Kelompok<span class="text-danger">*</span></label>
                                                        <div class="col-sm-12 col-md-10">
                                                            <select class="select2 form-control @error('kelompok') is-invalid @enderror" id="kelompok" name="kelompok" data-placeholder="Pilih kelompok praktikum" required style="width: 100%">
                                                                <option value=""></option>
                                                                @for ($i = 1; $i <= 30; $i++)
                                                                    <option value="{{ $i }}">Kelompok {{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                            @error('kelompok')
                                                                <div class="invalid-feedback text-start">
                                                                    {{ $message }}
                                                                </div>
                                                            @else
                                                                <div class="invalid-feedback">
                                                                    Peserta praktikum wajib dipilih
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button class="btn btn-sm btn-success">
                                                                <i class="fas fa-save"></i>
                                                                <span class="border-end mx-2"></span>
                                                                Tambah Peserta Praktikum
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="tbPesertaPraktikum" class="table table-responsive-sm table-bordered table-hover">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Peserta Praktikum</th>
                                                    <th>Kelompok</th>
                                                    <th>Asisten Praktikum</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kelompok_praktikum as $data)
                                                    <tr class="text-center align-middle my-auto">
                                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                                        <td class="align-middle">{{ $data->pesertaPraktikum->detailLogin->nama ?? '-' }}</td>
                                                        <td class="align-middle">{{ $data->kelompok ?? '-' }}</td>
                                                        <td class="align-middle">{{ $data->asistenPraktikum->detailLogin->nama ?? '-' }}</td>
                                                        <td class="text-center align-middle">
                                                            <button onclick="hapusAnggotaPraktikum('{{ $data->id }}')" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="" id="hapus-asisten-praktikum" method="POST" class="d-inline">
        @csrf
    </form>
    <form action="" id="hapus-anggota-praktikum" method="POST" class="d-inline">
        @csrf
    </form>
@endsection

@push('js')
    <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('template/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

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

            bsCustomFileInput.init();

            $('.select2').select2({
                placeholder: "Select a state",
                allowClear: true
            })
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });

        $(function () {
            $("#tbAsistenPraktikum").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data tidak ditemukan",
                    "sSearchPlaceholder": "Cari asisten praktikum ...",
                    "emptyTable": "Tidak terdapat asisten praktikum",
                    "infoEmpty": "Menampilkan 0 data",
                    "infoFiltered": "(dari _MAX_ Data)"
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                },
            });

            $("#tbPesertaPraktikum").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data tidak ditemukan",
                    "sSearchPlaceholder": "Cari peserta praktikum ...",
                    "emptyTable": "Tidak terdapat peserta praktikum",
                    "infoEmpty": "Menampilkan 0 data",
                    "infoFiltered": "(dari _MAX_ Data)"
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                },
            });
        });

        function hapusAsistenPraktikum(id) {
            Swal.fire({
            title: 'Peringatan',
            text: 'Apakah anda yakin akan menghapus Asisten Praktikum?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Ya, hapus",
            cancelButtonText: 'Tidak, batalkan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#hapus-asisten-praktikum').attr('action', "{{ route('Delete Asisten Praktikum', '') }}"+"/"+id);
                    $('#hapus-asisten-praktikum').submit();
                }
            })
        }

        function hapusAnggotaPraktikum(id) {
            Swal.fire({
            title: 'Peringatan',
            text: 'Apakah anda yakin akan menghapus Peserta Praktikum?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Ya, hapus",
            cancelButtonText: 'Tidak, batalkan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#hapus-anggota-praktikum').attr('action', "{{ route('Delete Anggota Praktikum', '') }}"+"/"+id);
                    $('#hapus-anggota-praktikum').submit();
                }
            })
        }
    </script>
@endpush

