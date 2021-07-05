@extends('layouts/admin-layout')

@section('title', 'Praktikum | Edit Praktikum')

@push('css')
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h3 class="col-lg-auto text-center text-md-start my-auto">Praktikum</h3>
        <div class="col-auto ml-auto text-right mt-n1 my-auto">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('All Praktikum') }}">Data Praktikum</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit praktikum</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header my-auto">
                        <p class="text-md-start text-center my-auto">Edit Data Praktikum</p>
                    </div>
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
                                            @else
                                               <option value="{{ $data->id }}">{{ $data->nama_praktikum }}</option>
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
                                            @else
                                               <option value="{{ $data->id }}">{{ $data->nama }}</option>
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
                                            @else
                                                <option value="{{ $data->id }}">{{ $data->detailLogin->nama }}, {{ $data->detailLogin->nim }}</option>
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
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
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

