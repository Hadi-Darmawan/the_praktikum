@extends('layouts/admin-layout')

@section('title', 'Detail Role Akun')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Manajemen Akun</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Roles Data') }}">Jabatan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit jabatan</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header my-auto">
                        <p class="my-auto">Edit Jabatan Akun</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-12 col-md-2 col-form-label">Nama</label>
                            <div class="col-sm-12 col-md-10 my-auto">
                                <div class="form-control">
                                    {{ $login->detailLogin->nama ?? 'Belum ditambahkan' }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-12 col-md-2 col-form-label">Username</label>
                            <div class="col-sm-12 col-md-10 my-auto">
                                <div class="form-control">
                                    {{ $login->username ?? 'Belum ditambahkan' }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-sm-12 col-md-2 col-form-label">Role</label>
                            <div class="col-sm-12 col-md-10 my-auto">
                                <div class="card-body border rounded p-2">
                                    <ul class="list-unstyled m-0 mx-1">
                                        @forelse ($detail_role as $data)
                                            <li>{{ $loop->iteration }}. {{ $data->role->nama_role }}</li>
                                        @empty
                                            <li>Belum ditambahkan</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#account-management').addClass('menu-is-opening menu-open');
            $('#account-management-link').addClass('active');
            $('#roles').addClass('active');
        });
    </script>
@endpush