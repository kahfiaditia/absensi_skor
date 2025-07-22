@extends('layouts.main')

@section('evoting')
<div class="page-content">
    <div class="container-fluid">
        
        <!-- Page Header -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18 text-primary"><i class="fas fa-user-plus me-2"></i>{{ $label }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">{{ ucwords($menu) }}</li>
                            <li class="breadcrumb-item active">Tambah Admin</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0 text-dark"><i class="fas fa-user-cog me-2"></i>Informasi Administrator</h5>
            </div>
            
            <form class="needs-validation" action="{{ route('user_admin.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="card-body">
                    <!-- Alert Section -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Perhatian!</strong> Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- User Information Section -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-dark mb-3"><i class="fas fa-id-card me-2"></i>Data Pribadi</h6>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="roles" class="form-label">Roles <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-user-tag"></i></span>
                                    <input type="text" class="form-control" id="roles" name="roles" value="Administrator" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" autocomplete="off" maxlength="30" required>
                                </div>
                                <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                                {!! $errors->first('name', '<div class="text-danger small mt-1">:message</div>') !!}
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="contoh@domain.com" autocomplete="off" maxlength="50" required>
                                </div>
                                <div class="invalid-feedback">Email yang valid wajib diisi.</div>
                                {!! $errors->first('email', '<div class="text-danger small mt-1">:message</div>') !!}
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 8 karakter" autocomplete="off" maxlength="50" required>
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback">Password wajib diisi (minimal 8 karakter).</div>
                                {!! $errors->first('password', '<div class="text-danger small mt-1">:message</div>') !!}
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-dark mb-3"><i class="fas fa-address-book me-2"></i>Kontak & Alamat</h6>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor Telepon</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">+62</span>
                                    <input type="number" class="form-control" id="phone" name="phone" placeholder="8123456789" autocomplete="off" maxlength="20">
                                </div>
                                {!! $errors->first('phone', '<div class="text-danger small mt-1">:message</div>') !!}
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-map-marker-alt"></i></span>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan alamat lengkap" autocomplete="off" maxlength="50">
                                </div>
                                {!! $errors->first('address', '<div class="text-danger small mt-1">:message</div>') !!}
                            </div>
                        </div>
                    </div>

                    <!-- Profile Picture Section -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-dark mb-3"><i class="fas fa-camera me-2"></i>Foto Profil</h6>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Unggah Foto</label>
                                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                                <div class="form-text">Format: JPG, PNG (Maks. 2MB)</div>
                                {!! $errors->first('avatar', '<div class="text-danger small mt-1">:message</div>') !!}
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="avatar-preview">
                                <img id="avatarPreview" src="{{ asset('assets/images/users/default-avatar.jpg') }}" class="img-thumbnail rounded-circle" width="100" height="100" alt="Preview">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="card-footer bg-white border-top d-flex justify-content-between">
                    <a href="{{ route('user_admin.index') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary" id="submit">
                        <i class="fas fa-save me-2"></i>Simpan Data
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
    // Password visibility toggle
    document.querySelectorAll('.toggle-password').forEach(function(button) {
        button.addEventListener('click', function() {
            const passwordInput = this.previousElementSibling;
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    });

    // Avatar preview
    document.getElementById('avatar').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file && file.type.match('image.*')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
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
    
    .form-label {
        font-weight: 500;
        color: #495057;
    }
    
    .input-group-text {
        transition: all 0.3s;
    }
    
    .toggle-password {
        cursor: pointer;
    }
    
    .toggle-password:hover {
        background-color: #f8f9fa;
    }
    
    .avatar-preview {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }
</style>
@endsection