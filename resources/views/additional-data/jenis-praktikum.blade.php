@extends('layouts/admin-layout')

@section('title', 'Data Jenis Praktikum')

@push('css')
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
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
                                <h3 class="card-title my-auto">Daftar Jenis Praktikum</h3>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#tambahJenisPraktikum" aria-expanded="false" aria-controls="tambahJenisPraktikum">
                                    <i class="fas fa-user-plus"></i>
                                    <span class="border-end mx-2"></span>
                                    Tambah
                                </button>
                            </div>
                        </div>
                        <div class="collapse my-4" id="tambahJenisPraktikum">
                            <div class="card card-body d-flex justify-content-end">
                                <form action="{{ route('Save Jenis Praktikum') }}" method="POST" class="needs-validation my-auto" novalidate>
                                    @csrf
                                    <div class="form-group form-group-sm row">
                                        <label for="nama_praktikum" class="col-sm-12 col-md-2 col-form-label">Nama Praktikum</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="input-group my-auto">
                                                <span class="input-group-text" id="basic-addon3">Praktikum</span>
                                                <input name="nama_praktikum" type="text" class="form-control @error('nama_praktikum') is-invalid @enderror" id="nama_praktikum" placeholder="Masukan nama praktikum" value="{{ old('nama_praktikum') }}" autocomplete="off" required>
                                                @error('nama_praktikum')
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @else
                                                    <div class="invalid-feedback">
                                                        Nama jenis praktikum wajib diisi
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm row">
                                        <label for="semester" class="col-sm-12 col-md-2 col-form-label">Semester</label>
                                        <div class="col-sm-12 col-md-10">
                                            <select class="select2 form-control @error('semester') is-invalid @enderror" id="semester" name="semester" data-placeholder="Pilih semester" required style="width: 100%">
                                                <option value=""></option>
                                                <option value="II (Dua)">II (Dua)</option>
                                                <option value="III (Tiga)">III (Tiga)</option>
                                                <option value="IV (Empat)">IV (Empat)</option>
                                                <option value="V (Lima)">V (Lima)</option>
                                                <option value="VI (Enam)">VI (Enam)</option>
                                            </select>
                                            @error('semester')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @else
                                                <div class="invalid-feedback">
                                                    Semester wajib Dipilih
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm row">
                                        <label for="konsentrasi" class="col-sm-12 col-md-2 col-form-label">Konsentrasi</label>
                                        <div class="col-sm-12 col-md-10">
                                            <select class="select2 form-control @error('konsentrasi') is-invalid @enderror" id="konsentrasi" name="konsentrasi" data-placeholder="Pilih konsentrasi" required style="width: 100%">
                                                <option value=""></option>
                                                <option value="Umum">Umum</option>
                                                <option value="TC">TC</option>
                                                <option value="MKJ">MKJ</option>
                                                <option value="MDI">MDI</option>
                                                <option value="MB">MB</option>
                                            </select>
                                            @error('konsentrasi')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @else
                                                <div class="invalid-feedback">
                                                    Akun Admin Wajib Dipilih
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button class="btn btn-sm btn-success">
                                                <i class="fas fa-save"></i>
                                                <span class="border-end mx-2"></span>
                                                Simpan Praktikum
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="tbAccount" class="table table-responsive-sm table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Semester</th>
                                    <th>Konsentrasi</th>
                                    <th>Status</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jenis_praktikum as $data)
                                    <tr class="text-center align-middle my-auto">
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $data->nama ?? '-' }}</td>
                                        <td class="align-middle">{{ $data->semester ?? '-' }}</td>
                                        <td class="align-middle">{{ $data->konsentrasi ?? '-' }}</td>
                                        @if ($data->deleted_at == NULL)
                                            <td class="align-middle">Tersedia</td>
                                            <td class="text-center align-middle">
                                                <button onclick="hapusJenisPraktikum('{{ $data->id }}')" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        @else
                                            <td class="align-middle">Terhapus</td>
                                            <td class="text-center align-middle">
                                                -
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="" id="hapus-jenis-praktikum" method="POST" class="d-inline">
        @csrf
    </form>
@endsection

@push('js')
    <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
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

    <script type="text/javascript">
        $(document).ready(function(){
            $('#additional-data').addClass('menu-is-opening menu-open');
            $('#additional-data-link').addClass('active');
            $('#jenis-praktikum').addClass('active');

            $('.select2').select2({
                placeholder: "Select a state",
                allowClear: true
            })
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });

        $(function () {
            $("#tbAccount").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data tidak ditemukan",
                    "sSearchPlaceholder": "Cari praktikum ...",
                    "emptyTable": "Tidak terdapat jenis praktikum",
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

        function hapusJenisPraktikum(id) {
            Swal.fire({
            title: 'Peringatan',
            text: 'Apakah anda yakin akan menghapus Jenis Praktikum? Data yang terhapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Ya, hapus",
            cancelButtonText: 'Tidak, batalkan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#hapus-jenis-praktikum').attr('action', "{{ route('Delete Jenis Praktikum', '') }}"+"/"+id);
                    $('#hapus-jenis-praktikum').submit();
                }
            })
        }
    </script>
@endpush