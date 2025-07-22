@extends('layouts.main')

@section('evoting')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18 text-primary">
                        <i class="fas fa-user-circle me-2"></i>Profil Pengguna
                    </h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profil</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- User Profile Header -->
                        <div class="text-center mb-4">
                            <div class="avatar-xxl mx-auto mb-3">
                                @if ($profil->avatar)
                                    <img src="{{ URL::asset('avatar/' . $profil->avatar) }}" 
                                         class="rounded-circle img-thumbnail" 
                                         alt="Profile Image">
                                @else
                                    <div class="avatar-title rounded-circle bg-soft-primary text-primary display-4">
                                        {{ substr($profil->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <h4 class="mb-1">{{ $profil->name }}</h4>
                            <p class="text-muted mb-0">
                                <i class="fas fa-id-card-alt me-1"></i>
                                {{ Auth::user()->roles == 'siswa' ? 'NIS' : 'NIK' }}: {{ $profil->nis }}
                            </p>
                        </div>

                        <!-- Profile Form -->
                        <form class="needs-validation" action="{{ route('pengguna.updateprofil', $profil->id) }}" method="POST" novalidate>
                            @csrf
                            @method('PATCH')
                            
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                                            <input name="nama" type="text" class="form-control" 
                                                   value="{{ $profil->name }}" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-envelope"></i></span>
                                            <input name="email" type="email" class="form-control" 
                                                   value="{{ $profil->email }}" required>
                                        </div>
                                        <div class="invalid-feedback">Email wajib diisi</div>
                                        {!! $errors->first('email', '<div class="text-danger small mt-1">:message</div>') !!}
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">PIN</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                                            <input name="pin" type="password" class="form-control" 
                                                   value="{{ $profil->pin }}" maxlength="4" required>
                                            <button class="btn btn-outline-secondary toggle-pin" type="button">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="invalid-feedback">PIN wajib diisi (4 digit)</div>
                                        {!! $errors->first('pin', '<div class="text-danger small mt-1">:message</div>') !!}
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea class="form-control" name="alamat" rows="2" readonly>{{ $profil->address }}</textarea>
                                    </div>
                                </div>
                                
                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-user-tag"></i></span>
                                            <input type="text" class="form-control" 
                                                   value="{{ ucfirst($profil->roles) }}" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">{{ Auth::user()->roles == 'siswa' ? 'NIS' : 'NIK' }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-id-card"></i></span>
                                            <input name="nis" type="text" class="form-control" 
                                                   value="{{ $profil->nis }}" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Password Baru</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-key"></i></span>
                                            <input name="password" type="password" class="form-control" 
                                                   placeholder="Kosongkan jika tidak ingin mengubah">
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Telepon</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-phone"></i></span>
                                            <input name="phone" type="tel" class="form-control" 
                                                   value="{{ $profil->phone }}" required>
                                        </div>
                                        <div class="invalid-feedback">Nomor telepon wajib diisi</div>
                                        {!! $errors->first('phone', '<div class="text-danger small mt-1">:message</div>') !!}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Form Actions -->
                            <div class="d-flex justify-content-end gap-3 mt-4">
                                <a href="{{ route('dashboard') }}" class="btn btn-light">
                                    <i class="fas fa-times me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Toggle password visibility
        $('.toggle-password').click(function() {
            const input = $(this).siblings('input');
            const icon = $(this).find('i');
            
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
        
        // Toggle PIN visibility
        $('.toggle-pin').click(function() {
            const input = $(this).siblings('input');
            const icon = $(this).find('i');
            
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>
@endpush

<style>
    .card {
        border-radius: 10px;
        border: none;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.05);
    }
    
    .avatar-xxl {
        width: 120px;
        height: 120px;
    }
    
    .avatar-title {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        font-size: 3rem;
    }
    
    .input-group-text {
        transition: all 0.3s;
    }
    
    .toggle-password, .toggle-pin {
        cursor: pointer;
    }
    
    .toggle-password:hover, .toggle-pin:hover {
        background-color: #f8f9fa;
    }
    
    .form-control:read-only {
        background-color: #f8f9fa;
    }
</style>
@endsection