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
                            <i class="fas fa-clock me-2"></i>{{ $label }}
                        </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ ucwords($menu) }}</li>
                        </ol>
                    </div>
                    <div class="page-title-right">
                        @if ($data_jam->isEmpty())
                        <a href="{{ route('setting_data.create') }}" 
                           class="btn btn-primary btn-rounded waves-effect waves-light">
                            <i class="mdi mdi-plus-circle-outline me-1"></i> Tambah Jadwal
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
                            <i class="fas fa-calendar-alt me-2"></i>Daftar Jadwal Kerja
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover table-bordered dt-responsive nowrap w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center">Hari</th>
                                        <th class="text-center">Jam Masuk</th>
                                        <th class="text-center">Jam Pulang</th>
                                        <th class="text-center" width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $namaHari = [
                                            1 => 'Senin',
                                            2 => 'Selasa',
                                            3 => 'Rabu',
                                            4 => 'Kamis',
                                            5 => 'Jumat',
                                            6 => 'Sabtu',
                                            7 => 'Minggu',
                                        ];
                                    @endphp
                                    
                                    @foreach ($data_jam as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-pill p-2">
                                                {{ $namaHari[$item->id_hari] ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-success text-white p-2">
                                                <i class="fas fa-sign-in-alt me-2"></i>{{ $item->jam_masuk }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-danger text-white p-2">
                                                <i class="fas fa-sign-out-alt me-2"></i>{{ $item->jam_pulang }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <form class="delete-form" action="{{ route('setting_data.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('setting_data.edit', Crypt::encryptString($item->id)) }}"
                                                       class="btn btn-sm btn-outline-warning" 
                                                       data-bs-toggle="tooltip" 
                                                       title="Edit Jadwal">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger delete_confirm"
                                                            data-bs-toggle="tooltip"
                                                            title="Hapus Jadwal">
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
</style>
@endsection