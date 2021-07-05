@extends('layouts/admin-layout')

@section('title', 'Praktikum | Detail Nilai')

@push('css')
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('content')  
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h3 class="col-lg-auto text-center text-md-start">Praktikum</h3>
        <div class="col-auto ml-auto text-right mt-n1 my-auto">
            <nav aria-label="breadcrumb text-center my-auto">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('All Nilai') }}">Nilai</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail nilai</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid p-0">
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
            @if ($penilaian->count() > 0)
                <div class="col-12 mb-5">
                    <div class="card">
                        <div class="card-header ">
                            <p class="my-auto">Nilai Praktikum</p>
                        </div>
                        <div class="card-body small">
                            <div class="card-body table-responsive px-0">
                                <table id="tbNilaiAkhir" class="table small table-responsive-md table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            @foreach ($penilaian as $data)
                                                <th scope="col">{{ $data->nama_penilaian }} ({{ $data->persentase_nilai }}%)</th>
                                            @endforeach
                                            <th scope="col">Total</th>
                                            <th scope="col">Huruf</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center align-middle my-auto">
                                            @foreach ($nilai as $data)
                                                <td class="align-middle">{{ $data->nilai }}</td>
                                            @endforeach
                                            @if ($nilai_total->count() > 0)
                                                @foreach ($nilai_total as $data)
                                                    <td class="align-middle">{{ $data->nilai_total }}</td>
                                                    <td class="align-middle">{{ $data->nilai_huruf }}</td>
                                                @endforeach
                                            @else
                                                <td class="align-middle">0</td>
                                                <td class="align-middle">E</td>
                                            @endif
                                        </tr>
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

    <script type="text/javascript">
        $(document).ready(function(){
            $('#praktikum-management').addClass('menu-is-opening menu-open');
            $('#praktikum-management-link').addClass('active');
            $('#nilai').addClass('active');
        });

        $(function () {
            $("#tbNilaiAkhir").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "searching": false,
                "ordering": false,
                "paging": false,
                "info": false,
            });
        });
    </script>
@endpush