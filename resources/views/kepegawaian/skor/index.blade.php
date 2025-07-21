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
                                
                                    <a href="{{ route('skor_data.create') }}" type="button"
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
                                        <th>Status Kehadiran</th>
                                        <th>Skor</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_skor as $item )
                                        <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->status_kehadiran }}</td>
                                        <td>{{ $item->skor }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>
                                        <form class="delete-form"
                                                    action="{{ route('jabatan_data.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="d-flex gap-3">
                                                        <a href="{{ route('jabatan_data.edit', Crypt::encryptString($item->id)) }}"
                                                            class="" data-bs-toggle="tooltip"
                                                            data-bs-original-title="Edit">
                                                            <i class="fas fa-user-edit text-warning"></i>
                                                        </a>
                                                        {{-- <a href="{{ route('setting_data.show', Crypt::encryptString($item->id)) }}"
                                                            class="" data-bs-toggle="tooltip"
                                                            data-bs-original-title="View">
                                                            <i class="fas fa-eye text-info"></i>
                                                        </a> --}}
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
