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
                            <i class="fas fa-star me-2"></i>{{ $label }}
                        </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ ucwords($menu) }}</li>
                        </ol>
                    </div>
                    <div class="page-title-right">
                        <a href="{{ route('skor_data.create') }}" 
                           class="btn btn-primary btn-rounded waves-effect waves-light">
                            <i class="mdi mdi-plus-circle-outline me-1"></i> Tambah Skor
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
                            <i class="fas fa-list-check me-2"></i>Daftar Skor Kehadiran
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover table-bordered dt-responsive nowrap w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center">Status Kehadiran</th>
                                        <th class="text-center">Skor</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center" width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_skor as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($item->status_kehadiran == 'Hadir') bg-success
                                                @elseif($item->status_kehadiran == 'Izin') bg-info
                                                @elseif($item->status_kehadiran == 'Sakit') bg-primary
                                                @elseif($item->status_kehadiran == 'Tanpa Keterangan') bg-danger
                                                @else bg-secondary
                                                @endif rounded-pill p-2">
                                                {{ $item->status_kehadiran }}
                                            </span>
                                        </td>
                                        <td class="text-center fw-bold text-primary">{{ $item->skor }}</td>
                                        <td>{{ $item->keterangan ?? '-' }}</td>
                                        <td class="text-center">
                                            <form class="delete-form" action="{{ route('skor_data.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('skor_data.edit', Crypt::encryptString($item->id)) }}"
                                                       class="btn btn-sm btn-outline-warning" 
                                                       data-bs-toggle="tooltip" 
                                                       title="Edit Skor">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger delete_confirm"
                                                            data-bs-toggle="tooltip"
                                                            title="Hapus Skor">
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
{{-- <script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
        
        // Delete confirmation
        $('.delete_confirm').on('click', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data skor akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script> --}}
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
        min-width: 120px;
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
    
    .fw-bold {
        font-size: 1.1rem;
    }
</style>
@endsection