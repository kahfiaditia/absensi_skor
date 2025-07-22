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
                            <i class="fas fa-users-cog me-2"></i>{{ $label }}
                        </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ ucwords($menu) }}</li>
                        </ol>
                    </div>
                    <div class="page-title-right">
                        @if (Auth::user()->id == 1)
                        <a href="{{ route('user_admin.create') }}" 
                           class="btn btn-primary btn-rounded waves-effect waves-light">
                            <i class="mdi mdi-account-plus me-1"></i> Tambah Admin
                        </a>
                        @endif
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
                            <i class="fas fa-user-shield me-2"></i>Daftar Administrator
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover table-bordered dt-responsive nowrap w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>NIP</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center" width="12%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_user as $user)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="fw-semibold">
                                            <div class="d-flex align-items-center">
                                                @if($user->avatar)
                                                <img src="{{ asset('storage/'.$user->avatar) }}" 
                                                     class="rounded-circle me-3" 
                                                     width="36" height="36" 
                                                     alt="{{ $user->name }}">
                                                @else
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                        {{ substr($user->name, 0, 1) }}
                                                    </span>
                                                </div>
                                                @endif
                                                {{ $user->name }}
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge bg-info rounded-pill px-2">
                                                {{ $user->nip ?? '-' }}
                                            </span>
                                        </td>
                                        <td>{{ Str::limit($user->address, 20) ?? '-' }}</td>
                                        <td>{{ $user->phone ?? '-' }}</td>
                                        <td class="text-center">
                                            <span class="badge 
                                                @if($user->roles == 'Administrator') bg-success
                                                @elseif($user->roles == 'Operator') bg-primary
                                                @else bg-secondary
                                                @endif rounded-pill px-3">
                                                {{ $user->roles }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if(Auth::user()->id == 1)
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('user_admin.edit', Crypt::encryptString($user->id)) }}"
                                                   class="btn btn-sm btn-outline-warning" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Edit Data">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form class="delete-form d-inline" 
                                                      action="{{ route('user_admin.destroy', $user->id) }}" 
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
                                            @else
                                            <span class="text-muted">No Action</span>
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
        background-color: #ffc107;
        border-color: #ffc107;
    }
    
    .btn-outline-danger:hover {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
    
    .avatar-sm {
        display: inline-block;
        width: 36px;
        height: 36px;
    }
    
    .avatar-title {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        font-size: 1rem;
    }
</style>
@endsection