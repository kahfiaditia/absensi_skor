@extends('layouts.main')

@section('evoting')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Tambah Skor Kehadiran</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Kepegawaian</li>
                                <li class="breadcrumb-item active">Skor</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('skor_data.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body row">
                                <!-- Status Kehadiran -->
                                <div class="col-md-4 mb-3">
                                    <label for="status_kehadiran" class="form-label">Status Kehadiran <code>*</code></label>
                                    <input type="text" class="form-control text-uppercase" name="status_kehadiran"
                                        id="status_kehadiran" placeholder="Contoh: TEPAT WAKTU" required maxlength="50" oninput="this.value = this.value.toUpperCase()">
                                    <div class="invalid-feedback">Status kehadiran wajib diisi.</div>
                                    {!! $errors->first('status_kehadiran', '<div class="text-danger mt-1">:message</div>') !!}
                                </div>

                                <!-- Skor -->
                                <div class="col-md-4 mb-3">
                                    <label for="skor" class="form-label">Skor <code>*</code></label>
                                    <input type="number" class="form-control" name="skor" id="skor"
                                        placeholder="Contoh: 100" required>
                                    <div class="invalid-feedback">Skor wajib diisi.</div>
                                    {!! $errors->first('skor', '<div class="text-danger mt-1">:message</div>') !!}
                                </div>

                                <!-- Keterangan -->
                                <div class="col-md-4 mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" id="keterangan"
                                        placeholder="Contoh: Hadir tepat waktu" maxlength="50">
                                    {!! $errors->first('keterangan', '<div class="text-danger mt-1">:message</div>') !!}
                                </div>

                                <div class="col-md-12 mt-3">
                                    <a href="{{ route('skor_data.index') }}"
                                        class="btn btn-secondary waves-effect">Batal</a>
                                    <button type="submit"
                                        class="btn btn-primary waves-effect waves-light float-end">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
