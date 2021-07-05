@extends('layouts/admin-layout')

@section('title', 'Detail Penilaian')

@push('css')
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
                    <li class="breadcrumb-item active" aria-current="page">Detail penilaian</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
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
            <div class="col-12 my-3">
                <div class="card">
                    <div class="card-header">Tambah Penilaian</div>
                    <div class="card-body">
                        <form action="{{ route('Add Penilaian', $praktikum->id) }}" method="POST" class="form-horizontal needs-validation" novalidate>
                            @csrf
                            <div class="form-group row">
                                <label for="peserta_praktikum" class="col-sm-12 col-md-2 col-form-label">Peserta Praktikum<span class="text-danger">*</span></label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <select class="select2 form-control @error('peserta_praktikum') is-invalid @enderror" name="peserta_praktikum" id="peserta_praktikum" data-placeholder="Pilih peserta praktikum" required style="width: 100%">
                                        <option value=""></option>
                                        @foreach ($peserta_praktikum as $data)
                                            <option value="{{ $data->id_peserta_praktikum }}">{{ $data->pesertaPraktikum->detailLogin->nama }}, {{ $data->pesertaPraktikum->detailLogin->nim }}</option>
                                        @endforeach
                                    </select>
                                    @error('peserta_praktikum')
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
                                <label for="data_penilaian" class="col-sm-12 col-md-2 col-form-label">Jenis Penilaian<span class="text-danger">*</span></label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <select class="select2 form-control @error('data_penilaian') is-invalid @enderror" name="data_penilaian" id="data_penilaian" data-placeholder="Pilih jenis penilaian" required style="width: 100%">
                                        <option value=""></option>
                                        @foreach ($penilaian as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_penilaian }} ({{ $data->persentase_nilai }})</option>
                                        @endforeach
                                    </select>
                                    @error('data_penilaian')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="invalid-feedback">
                                            Nama penilaian wajib dipilih
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nilai" class="col-sm-12 col-md-2 col-form-label">Nilai<span class="text-danger">*</span></label>
                                <div class="col-sm-12 col-md-10 my-auto">
                                    <input name="nilai" type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai" placeholder="Masukan nilai" value="{{ old('nilai') }}" autocomplete="off" required>
                                    @error('nilai')
                                        <div class="invalid-feedback text-start">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="invalid-feedback">
                                            Nilai wajib diisi
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-12 text-end">
                                    <p class="text-danger small"><span>*</span> Data Wajib Diisi</p>
                                </div>
                                <div class="col-12 d-grid">
                                    <button type="submit" class="btn btn-sm btn-outline-success my-1">Tambah Penilaian</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if ($penilaian->count() > 0 && $peserta_praktikum->count() > 0)
                <div class="col-12 mb-5">
                    <div class="card">
                        <div class="card-header ">
                            <div class="row">
                                <div class="col-12 my-auto">
                                    <p class="my-auto">Daftar Hasil Penilaian</p>
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
                                                <th scope="col">{{ $data->nama_penilaian }} ({{ $data->persentase_nilai }}%)</th>
                                            @endforeach
                                            <th scope="col">Total</th>
                                            <th scope="col">Huruf</th>
                                        </tr>
                                    </thead>
                                    <tbody class="small">
                                        @foreach ($peserta_praktikum as $data)
                                            <tr class="text-center align-middle my-auto">
                                                <td class="align-middle">{{ $loop->iteration }}</td>
                                                <td class="align-middle">{{ $data->pesertaPraktikum->detailLogin->nama ?? '-' }}</td>
                                                @if ($nilai->where('id_login', $data->id_peserta_praktikum)->count() > 0)
                                                    @foreach ($nilai->where('id_login', $data->id_peserta_praktikum) as $value)
                                                        <td class="align-middle">{{ $value->nilai }}</td>
                                                    @endforeach
                                                @else
                                                    @foreach ($penilaian as $data)
                                                        <td class="align-middle">0</td>
                                                    @endforeach
                                                    @endif
                                                @if ($nilai_total->where('id_login', $data->id_peserta_praktikum)->count() > 0)
                                                    @foreach ($nilai_total->where('id_login', $data->id_peserta_praktikum) as $item)
                                                        <td class="align-middle">{{ $item->nilai_total }}</td>
                                                        <td class="align-middle">{{ $item->nilai_huruf }}</td>
                                                    @endforeach
                                                @else
                                                    <td class="align-middle">0</td>
                                                    <td class="align-middle">E</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    <script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>

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
            $("#tbNilaiAkhir").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false, "ordering": false, "paging": false, "info": false,
                "buttons": [
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-download"></i><span class="border-end mx-2"></span>Download',
                        className: 'btn btn-sm btn-success'
                    }
                ],
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data tidak ditemukan",
                    "sSearchPlaceholder": "Cari data ...",
                    "emptyTable": "Tidak terdapat data nilai",
                    "infoEmpty": "Menampilkan 0 data",
                    "infoFiltered": "(dari _MAX_ Data)"
                },
            }).buttons().container().addClass('d-flex justify-content-end').appendTo('#tbNilaiAkhir_wrapper');
        });
    </script>
@endpush

