@extends('layouts/admin-layout')

@section('title', 'Addotional Daata | Peserta Praktikum')

@push('css')
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('content')  
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h3 class="col-lg-auto text-center text-md-start my-auto">Data Tambahan</h3>
        <div class="col-auto ml-auto text-right mt-n1 my-auto">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Dashboard') }}">The Praktikum</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data peserta praktikum</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <p class="my-auto text-md-start text-center">Daftar Data Peserta Praktikum</p>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="tbPesertaPraktikum" class="table table-responsive-sm table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Telpon</th>
                                    <th>Line</th>
                                    <th>Telegram</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peserta_praktikum as $data)
                                    <tr class="text-center align-middle my-auto">
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $data->detailLogin->nama ?? '-' }}</td>
                                        <td class="align-middle">{{ $data->detailLogin->nomor_telepon ?? '-' }}</td>
                                        <td class="align-middle">{{ $data->detailLogin->line_id ?? '-' }}</td>
                                        <td class="align-middle">{{ $data->detailLogin->useraname_telegram ?? '-' }}</td>
                                        <td class="align-middle">{{ $data->detailLogin->status ?? '-' }}</td>
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
            $('#additional-data').addClass('menu-is-opening menu-open');
            $('#additional-data-link').addClass('active');
            $('#peserta-praktikum-data').addClass('active');
        });

        $(function () {
            $("#tbPesertaPraktikum").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data tidak ditemukan",
                    "sSearchPlaceholder": "Cari peserta praktikum ...",
                    "emptyTable": "Tidak terdapat data peserta praktikum",
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
