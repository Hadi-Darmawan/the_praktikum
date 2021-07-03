@extends('layouts/admin-layout')

@section('title', 'Penilaian Praktikum')

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
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Dashboard') }}">The Praktikum</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Penilaian</li>
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
                                <h3 class="card-title my-auto">Daftar Penilaian</h3>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-sm btn-primary my-auto" type="button" data-bs-toggle="collapse" data-bs-target="#tambahPenilaian" aria-expanded="false" aria-controls="tambahPenilaian">
                                    <i class="fas fa-plus"></i>
                                    <span class="border-end mx-2"></span>
                                    Tambah
                                </button>
                            </div>
                        </div>
                        <div class="collapse my-4" id="tambahPenilaian">
                            <div class="card card-body d-flex justify-content-end">
                                <form action="{{ route('Add Penilaian') }}" method="POST" class="needs-validation my-auto" novalidate>
                                    @csrf
                                    <div class="row">
                                        <form action="" method="POST" class="needs-validation my-auto" novalidate>
                                            @csrf
                                            <div class="form-group form-group-sm row">
                                                <label for="praktikum" class="col-sm-12 col-md-2 col-form-label">Praktikum<span class="text-danger">*</span></label>
                                                <div class="col-sm-12 col-md-10">
                                                    <select class="select2 form-control @error('praktikum') is-invalid @enderror" id="praktikum" name="praktikum" data-placeholder="Pilih asisten praktikum" required style="width: 100%">
                                                        <option value=""></option>
                                                        @foreach ($praktikum as $data)
                                                            <option value="{{ $data->id }}">{{ $data->jenisPraktikum->nama_praktikum }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('praktikum')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @else
                                                        <div class="invalid-feedback">
                                                            Praktikum wajib dipilih
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm row">
                                                <label for="nama_penilaian" class="col-sm-12 col-md-2 col-form-label">Nama Penilaian<span class="text-danger">*</span></label>
                                                <div class="col-sm-12 col-md-10 my-auto">
                                                    <input name="nama_penilaian" type="text" class="form-control @error('nama_penilaian') is-invalid @enderror" id="nama_penilaian" placeholder="Masukan nama penilaian" value="{{ old('nama_penilaian') }}" autocomplete="off" required>
                                                    @error('nama_penilaian')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @else
                                                        <div class="invalid-feedback">
                                                            Nama penilaian wajib diisi
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="persentase_nilai" class="col-sm-12 col-md-2 col-form-label">Persentase Nilai<span class="text-danger">*</span></label>
                                                <div class="col-sm-12 col-md-10">
                                                    <select class="select2 form-control @error('persentase_nilai') is-invalid @enderror" id="persentase_nilai" name="persentase_nilai" data-placeholder="Pilih persentase nilai" required style="width: 100%">
                                                        <option value=""></option>
                                                        @for ($i = 1; $i <= 100; $i++)
                                                            <option value="{{ $i }}">{{ $i }} %</option>
                                                        @endfor
                                                    </select>
                                                    @error('persentase_nilai')
                                                        <div class="invalid-feedback text-start">
                                                            {{ $message }}
                                                        </div>
                                                    @else
                                                        <div class="invalid-feedback">
                                                            Persentase nilai wajib dipilih
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button class="btn btn-sm btn-success" type="submit">
                                                        <i class="fas fa-save"></i>
                                                        <span class="border-end mx-2"></span>
                                                        Tambah Penilaian
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="tbPenilaian" class="table table-responsive-sm table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Praktikum</th>
                                    <th>Penilaian</th>
                                    <th>Persentase</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penilaian as $data)
                                    <tr class="text-center align-middle my-auto">
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $data->praktikum->jenisPraktikum->nama_praktikum }}
                                        </td>
                                        <td class="align-middle">{{ $data->nama_penilaian ?? '-' }}</td>
                                        <td class="align-middle">{{ $data->persentase_nilai ?? '0' }} %</td>
                                        <td class="text-center align-middle">
                                            @if ($data->praktikum->nim_ketua_praktikum == auth()->guard()->user()->detailLogin->nim)
                                                <button onclick="hapusPenilaian('{{ $data->id }}')" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                    <span class="border-end mx-2"></span>
                                                    Hapus
                                                </button>
                                            @else
                                                -
                                            @endif
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
    <form action="" id="hapus-penilaian" method="POST" class="d-inline">
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
            $('#praktikum-management').addClass('menu-is-opening menu-open');
            $('#praktikum-management-link').addClass('active');
            $('#penilaian').addClass('active');

            $('.select2').select2({
                placeholder: "Select a state",
                allowClear: true
            })
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });

        $(function () {
            $("#tbPenilaian").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data tidak ditemukan",
                    "sSearchPlaceholder": "Cari penilaian ...",
                    "emptyTable": "Tidak terdapat data penilaian",
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

        function hapusPenilaian(id) {
            Swal.fire({
            title: 'Peringatan',
            text: 'Apakah anda yakin akan menghapus Penilaian?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Ya, hapus",
            cancelButtonText: 'Tidak, batalkan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#hapus-penilaian').attr('action', "{{ route('Delete Penilaian', '') }}"+"/"+id);
                    $('#hapus-penilaian').submit();
                }
            })
        }
    </script>
@endpush