@extends('layouts.main')
@section('evoting')
    {{-- ubah section ke yang sesuai jika pakai layout --}}
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ $label }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">{{ ucwords($menu) }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <form class="needs-validation" action="{{ route('pegawai_data.store') }}" enctype="multipart/form-data"
                method="POST" novalidate>
                @csrf
                <input type="hidden" name="flag" value="Pegawai">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">

                                {{-- Data Pegawai --}}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Lengkap <code>*</code></label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                required maxlength="50" autocomplete="off">
                                            <div class="invalid-feedback">Data wajib diisi.</div>
                                            {!! $errors->first('name', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="nip" class="form-label">NIP <code>*</code></label>
                                            <input type="text" name="nip" id="nip"
                                                class="form-control @error('nip') is-invalid @enderror"
                                                value="{{ old('nip') }}" autocomplete="off">
                                            @error('nip')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="invalid-feedback">Data wajib diisi.</div>
                                            {!! $errors->first('nip', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="id_departemen" class="form-label">Departemen <code>*</code></label>
                                            <select class="form-control select2" name="id_departemen" id="id_departemen"
                                                required>
                                                <option value="">-- Pilih Departemen --</option>
                                                @foreach ($data_departemen as $departemen)
                                                    <option value="{{ $departemen->id }}">{{ $departemen->nama_departemen }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="id_jabatan" class="form-label">Jabatan <code>*</code></label>
                                            <select class="form-control select2" name="id_jabatan" id="id_jabatan" required>
                                                <option value="">-- Pilih Jabatan --</option>
                                                @foreach ($data_jabatan as $jabatan)
                                                    <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- Info Kontak --}}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email <code>*</code></label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                maxlength="50" autocomplete="off" required>
                                            <div class="invalid-feedback">Data wajib diisi.</div>
                                            {!! $errors->first('name', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" name="address" id="address"
                                                maxlength="50" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Telepon</label>
                                            <input type="text" class="form-control" name="phone" id="phone"
                                                maxlength="20" autocomplete="off">
                                            <div class="invalid-feedback">Data wajib diisi.</div>
                                            {!! $errors->first('name', '<div class="invalid-validasi">:message</div>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="avatar" class="form-label">Foto (.jpg, .jpeg, .png max
                                                2MB)</label>
                                            <input type="file" class="form-control" name="avatar" id="avatar"
                                                accept=".jpg,.jpeg,.png">
                                        </div>
                                    </div>
                                </div>

                                {{-- Simpan --}}
                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <a href="{{ route('pegawai_data.index') }}"
                                            class="btn btn-secondary waves-effect">Batal</a>
                                        <button class="btn btn-primary" type="submit" style="float: right"
                                            id="submit">Simpan</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
