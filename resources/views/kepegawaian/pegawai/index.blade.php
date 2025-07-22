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
                            <i class="fas fa-users me-2"></i>{{ $label }}
                        </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ ucwords($menu) }}</li>
                        </ol>
                    </div>
                    <div class="page-title-right">
                        <a href="{{ route('pegawai_data.create') }}" 
                           class="btn btn-primary btn-rounded waves-effect waves-light">
                            <i class="mdi mdi-account-plus me-1"></i> Tambah Pegawai
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
                            <i class="fas fa-id-card me-2"></i>Daftar Pegawai
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover dt-responsive nowrap w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center">NIP</th>
                                        <th>Nama Pegawai</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th class="text-center" width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pegawai as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-pill px-3 py-2">
                                                {{ $item->nip }}
                                            </span>
                                        </td>
                                        <td class="fw-semibold">
                                            <div class="d-flex align-items-center">
                                                @if($item->avatar)
                                                <img src="{{ asset('storage/'.$item->avatar) }}" 
                                                     class="rounded-circle me-3" 
                                                     width="40" height="40" 
                                                     alt="{{ $item->name }}">
                                                @else
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-title bg-secondary rounded-circle">
                                                        {{ substr($item->name, 0, 1) }}
                                                    </span>
                                                </div>
                                                @endif
                                                {{ $item->name }}
                                            </div>
                                        </td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone ?? '-' }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('pegawai_data.edit', Crypt::encryptString($item->id)) }}"
                                                   class="btn btn-sm btn-outline-warning" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Edit Data">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('pegawai_data.show', Crypt::encryptString($item->id)) }}"
                                                   class="btn btn-sm btn-outline-info" 
                                                   data-bs-toggle="tooltip"
                                                   title="Detail Pegawai">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('cetak_barcode') }}" 
                                                   target="_blank"
                                                   class="btn btn-sm btn-outline-success"
                                                   data-bs-toggle="tooltip"
                                                   title="Cetak Barcode">
                                                    <i class="fas fa-barcode"></i>
                                                </a>
                                                <form class="delete-form d-inline" 
                                                      action="{{ route('pegawai_data.destroy', $item->id) }}" 
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger delete_confirm"
                                                            data-bs-toggle="tooltip"
                                                            title="Hapus Data">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
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
    
    .btn-outline-info:hover {
        color: #fff;
    }
    
    .btn-outline-success:hover {
        color: #fff;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
    
    .avatar-sm {
        display: inline-block;
        width: 40px;
        height: 40px;
    }
    
    .avatar-title {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        font-size: 1.2rem;
        color: white;
    }
</style>
@endsection