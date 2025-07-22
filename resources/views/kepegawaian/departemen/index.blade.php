@extends('layouts.main')

@section('evoting')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="page-title-left">
                        <h4 class="mb-sm-0 font-size-18 text-primary">
                            <i class="fas fa-building me-2"></i>{{ $label }}
                        </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ ucwords($menu) }}</li>
                        </ol>
                    </div>
                    <div class="page-title-right">
                        <a href="{{ route('departemen.create') }}" 
                           class="btn btn-primary btn-rounded waves-effect waves-light">
                            <i class="mdi mdi-plus-circle-outline me-1"></i> Tambah Departemen
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table Card -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0 text-dark">
                            <i class="fas fa-list-ul me-2"></i>Daftar Departemen
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover table-bordered dt-responsive nowrap w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center">Kode</th>
                                        <th class="text-center">Nama Departemen</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center" width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_departemen as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-info rounded-pill p-2">
                                                {{ $item->kode_departemen }}
                                            </span>
                                        </td>
                                        <td class="fw-semibold">{{ $item->nama_departemen }}</td>
                                        <td>{{ $item->keterangan ?? '-' }}</td>
                                        <td class="text-center">
                                            <form class="delete-form" action="{{ route('departemen.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('departemen.edit', Crypt::encryptString($item->id)) }}"
                                                       class="btn btn-sm btn-outline-warning" 
                                                       data-bs-toggle="tooltip" 
                                                       title="Edit Departemen">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger delete_confirm"
                                                            data-bs-toggle="tooltip"
                                                            title="Hapus Departemen">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </form>
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
</div>

@push('scripts')
<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/alert.js') }}"></script>

@endpush

<style>
    .card {
        border-radius: 10px;
        border: none;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.05);
    }
    
    .card-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }
    
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    
    .badge {
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .btn-outline-warning:hover {
        color: #fff;
    }
    
    .btn-outline-danger:hover {
        color: #fff;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
</style>
@endsection