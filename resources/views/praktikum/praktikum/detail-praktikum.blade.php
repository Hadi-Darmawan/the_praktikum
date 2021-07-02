@extends('layouts/admin-layout')

@section('title', 'Detail Praktikum')

@push('css')
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Praktikum</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('All Praktikum') }}">Praktikum</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail praktikum</li>
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
                        </ul>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content">
                            <div class="tab-pane active" id="dataPraktikum">
                                <div class="card shadow-none border-0 m-0">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label">Jenis Praktikum</label>
                                            <div class="col-sm-12 col-md-10">
                                                <div class="form-control">
                                                    {{ $jenis_praktikum->nama_praktikum }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label">Dosen Pengampu</label>
                                            <div class="col-sm-12 col-md-10">
                                                <div class="form-control">
                                                    {{ $praktikum->dosen_pengampu }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label">Ketua Praktikum</label>
                                            <div class="col-sm-12 col-md-10">
                                                <div class="form-control">
                                                    {{ $praktikum->ketua_praktikum }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label">Tahun Praktikum</label>
                                            <div class="col-sm-12 col-md-10">
                                                <div class="form-control">
                                                    {{ $praktikum->tahun }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label">File Modul</label>
                                            <div class="col-sm-12 col-md-10">
                                                <a href="{{ route('Download Modul Praktikum', $praktikum->modulPraktikum->id) }}" target="_blank" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-download"></i>
                                                    <span class="border-end mx-2"></span>
                                                    Download
                                                </a>
                                            </div>
                                        </div>
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
                                            <div class="col-12 my-auto">
                                                <h3 class="card-title my-auto">Daftar Asisten Praktikum</h3>
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
                                            <div class="col-12 my-auto">
                                                <h3 class="card-title my-auto">Daftar Peserta Praktikum</h3>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kelompok_praktikum as $data)
                                                    <tr class="text-center align-middle my-auto">
                                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                                        <td class="align-middle">{{ $data->pesertaPraktikum->detailLogin->nama ?? '-' }}</td>
                                                        <td class="align-middle">{{ $data->kelompok ?? '-' }}</td>
                                                        <td class="align-middle">{{ $data->asistenPraktikum->detailLogin->nama ?? '-' }}</td>
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
@endsection

@push('js')
    <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <script>
        $(document).ready(function(){
            $('#praktikum-management').addClass('menu-is-opening menu-open');
            $('#praktikum-management-link').addClass('active');
            $('#praktikum').addClass('active');
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
    </script>
@endpush

