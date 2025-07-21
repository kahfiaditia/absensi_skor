@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <h4 class="mb-sm-0 font-size-18">{{ $label }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">{{ ucwords($menu) }}</li>
                            </ol>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <a href="{{ route('pegawai_data.create') }}" type="button"
                                    class="float-end btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                    <i class="mdi mdi-plus me-1"></i> Tambah
                                </a>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pegawai as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nip }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                <form class="delete-form"
                                                    action="{{ route('pegawai_data.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="d-flex gap-3">
                                                        <a href="{{ route('pegawai_data.edit', Crypt::encryptString($item->id)) }}"
                                                            class="" data-bs-toggle="tooltip"
                                                            data-bs-original-title="Edit">
                                                            <i class="fas fa-user-edit text-warning"></i>
                                                        </a>
                                                        <a href="{{ route('pegawai_data.show', Crypt::encryptString($item->id)) }}"
                                                            class="" data-bs-toggle="tooltip"
                                                            data-bs-original-title="Edit">
                                                            <i class="fas fa-eye text-success"></i>
                                                        </a>
                                                        <a href="{{ route('cetak_barcode') }}" target="_blank"
                                                            data-bs-toggle="tooltip" title="Cetak Barcode">
                                                            <i class="fas fa-barcode text-success"></i>
                                                        </a>

                                                        <a href class="text-danger delete_confirm">
                                                            <i class="fas fa-trash font-size-15"></i></a>
                                                    </div>
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
    </div>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
@endsection
