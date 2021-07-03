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
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Jenis Praktikum</label>
                            <div class="col-sm-12 col-md-10">
                                <div class="form-control">
                                    {{ $praktikum->jenisPraktikum->nama_praktikum }}
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
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3 mb-5">
                <div class="card">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-12 my-auto">
                                <h3 class="card-title my-auto">Daftar Praktikum</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body small">
                        <div class="card-body table-responsive px-0">
                            <table id="tbNilaiAkhir" class="table table-xxl table-responsive-md table-bordered table-hover">
                                <thead class="text-center">
                                    <tr class="small">
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        @foreach ($penilaian as $data)
                                            <th scope="col">{{ $data->nama_penilaian }} {{ $data->persentase_nilai }}%</th>
                                        @endforeach
                                        <th scope="col">Nilai Akhir</th>
                                        <th scope="col">Predikat</th>
                                    </tr>
                                </thead>
                                <tbody class="small">
                                    @foreach ($nilai_total as $data)
                                        <tr class="text-center align-middle my-auto">
                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                            <td class="align-middle">{{ $data->login->detailLogin->nama ?? '-' }}</td>
                                            <td class="align-middle">{{ $data->nilai_total ?? '-' }}</td>
                                            <td class="align-middle">{{ $data->nilai_huruf ?? '-' }}</td>
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
            $('#nilai').addClass('active');
        });

        $(function () {
            $("#tbNilaiAkhir").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "ordering": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data tidak ditemukan",
                    "sSearchPlaceholder": "Cari data ...",
                    "emptyTable": "Tidak terdapat data nilai",
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

