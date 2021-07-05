@extends('layouts/admin-layout')

@section('title', 'Data Praktikum')

@push('css')
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('content')  
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Tambahan</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Dashboard') }}">The Praktikum</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Jenis praktikum</li>
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
                            <div class="col-6 my-auto">
                                <h3 class="card-title my-auto">Daftar Praktikum</h3>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn btn-success" href="{{ route('Add Praktikum') }}">
                                    <i class="fas fa-plus"></i>
                                    <span class="border-end mx-2"></span>
                                    Tambah
                                </a>
                            </div>
                        </div>
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
                                            @if ($data->nim_ketua_praktikum == auth()->guard()->user()->detailLogin->nim)
                                                <a href="{{ route('Detail Praktikum', $data->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                    <span class="border-end mx-2"></span>
                                                    Detail
                                                </a>
                                            @endif
                                            <a href="{{ route('Edit Praktikum', $data->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                                <span class="border-end border-dark mx-2"></span>
                                                Edit
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

    <script type="text/javascript">
        $(document).ready(function(){
            $('#praktikum-management').addClass('menu-is-opening menu-open');
            $('#praktikum-management-link').addClass('active');
            $('#praktikum').addClass('active');
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