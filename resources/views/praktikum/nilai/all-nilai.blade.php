@extends('layouts/admin-layout')

@section('title', 'Praktikum | Nilai')

@push('css')
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('content')  
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h3 class="col-lg-auto text-center text-md-start my-auto">Praktikum</h3>
        <div class="col-auto ml-auto text-right mt-n1 my-auto">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Dashboard') }}">The Praktikum</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nilai</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <p class="my-auto">Daftar Riwayat Praktikum</p>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="tbPraktikum" class="table table-responsive-sm table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Praktikum</th>
                                    <th>Tahun</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($praktikum as $data)
                                    <tr class="text-center align-middle my-auto">
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">Praktikum {{ $data->jenisPraktikum->nama_praktikum ?? '-' }}</td>
                                        <td class="align-middle">{{ $data->tahun ?? '-' }}</td>
                                        <td class="text-center align-middle">
                                            <a href="{{ route('Detail Nilai', $data->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-clipboard-check"></i>
                                                <span class="border-end mx-2"></span>
                                                Nilai
                                            </a>
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
@endsection

@push('js')
    <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#praktikum-management').addClass('menu-is-opening menu-open');
            $('#praktikum-management-link').addClass('active');
            $('#nilai').addClass('active');
        });

        $(function () {
            $("#tbPraktikum").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data tidak ditemukan",
                    "sSearchPlaceholder": "Cari praktikum ...",
                    "emptyTable": "Tidak terdapat data praktikum",
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