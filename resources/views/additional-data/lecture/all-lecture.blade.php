@extends('layouts/admin-layout')

@section('title', 'Additional Data | Data Dosen')

@push('css')
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('content')  
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h3 class="col-lg-auto text-center text-md-start my-auto">Additional Data</h3>
        <div class="col-auto ml-auto text-right mt-n1 my-auto">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Dashboard') }}">The Praktikum</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data dosen</li>
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
                            @roles(["Administrator"])
                                <div class="col-6 my-auto">
                                    <p class="my-auto">Daftar Data Dosen</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a class="btn btn-sm btn-success" href="{{ route('Add Lecture') }}">
                                        <i class="fas fa-user-plus"></i>
                                        <span class="border-end mx-2"></span>
                                        Tambah
                                    </a>
                                </div>
                            @else
                                <div class="col-12 my-auto">
                                    <p class="text-md-start text-center my-auto">Daftar Data Dosen</p>
                                </div>
                            @endroles
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="tbAccount" class="table table-responsive-sm table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telpon</th>
                                    <th>Telegram</th>
                                    <th>Status</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lecture as $data)
                                    <tr class="text-center align-middle my-auto">
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $data->nama ?? '-' }}</td>
                                        <td class="align-middle">{{ $data->email ?? '-' }}</td>
                                        <td class="align-middle">{{ $data->nomor_telepon ?? '-' }}</td>
                                        <td class="align-middle">{{ $data->username ?? '-' }}</td>
                                        <td class="align-middle">{{ $data->status ?? '-' }}</td>
                                        <td class="text-center align-middle">
                                            @roles(["Administrator"])
                                                <a href="{{ route('Edit Lecture', $data->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-user-edit"></i>
                                                </a>
                                                <button type="button" onclick="statusDosen('{{ $data->id }}', '{{ $data->status }}')" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @else
                                                -
                                            @endroles
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

    {{-- Modal --}}
    <div class="modal fade" id="accountStatus" tabindex="-1" aria-labelledby="accountStatusLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountStatusLabel">Status Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="formAccountStatus" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-7 d-grid">
                                <select class="form-select" name="status" id="accountStatusOption">
                                </select>
                            </div>
                            <div class="col-5 d-grid">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i>
                                    <span class="border-end mx-2"></span>
                                    Simpan Status
                                </button>
                            </div>
                        </div>
                    </form>
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
            $('#additional-data').addClass('menu-is-opening menu-open');
            $('#additional-data-link').addClass('active');
            $('#lecture-data').addClass('active');
        });

        $(function () {
            $("#tbAccount").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data tidak ditemukan",
                    "sSearchPlaceholder": "Cari dosen ...",
                    "emptyTable": "Tidak terdapat data dosen",
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

        function statusDosen(id, status) {
            $('#accountStatus').modal('show');
            $('#formAccountStatus').attr("action", "{{ route('Update Status Lecture', '') }}"+"/"+id);
            if (status == 'Aktif') {
                $('#accountStatusOption option').remove();
                $('#accountStatusOption').append(`<option selected value="${status}">${status}</option>`);
                $('#accountStatusOption').append(`<option value="Tidak Aktif">Tidak Aktif</option>`);
            } else if ( status == 'Tidak Aktif' ) {
                $('#accountStatusOption option').remove();
                $('#accountStatusOption').append(`<option selected value="${status}">${status}</option>`);
                $('#accountStatusOption').append(`<option value="Aktif">Aktif</option>`);
            }
        }
    </script>
@endpush
