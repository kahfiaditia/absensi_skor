@extends('layouts.main')
@section('evoting')

    <body>
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

                <div class="card-body">
                    <h4 class="card-title mb-3">{{ $title }}</h4>
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#all-order" role="tab">
                                Absensi Manual
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Barcode</a>
                        </li>
                    </ul>
                </div>
                <form id="form" class="needs-validation" action="{{ route('absensi_pegawai.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mt-12">
                                        <div class="col-lg-12">
                                            <div class="mb-12">
                                                <label for="formrow-firstname-input" class="form-label">NIP</label>
                                                <select id="nip" class="form-control select select2" name="nip"
                                                    required>
                                                    <option value="" selected>-- Pilih --</option>
                                                    <div class="invalid-feedback">
                                                        Data wajib diisi.
                                                    </div>
                                                    {!! $errors->first('nip', '<div class="invalid-validasi">:message</div>') !!}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3"></div>
                                    <div class="row mb-12">
                                        <div class="col-lg-12">
                                            <div class="mb-12">
                                                <label for="formrow-firstname-input" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="nama_pegawai"
                                                    name="nama_pegawai" placeholder="Nama Pegawai" readonly>
                                                <input type="text" class="form-control" id="jam_masuk" name="jam_masuk"
                                                    placeholder="Jam Masuk" value="{{ $jam_masuk->jam_masuk }}" hidden>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="row mt-12">
                                            <div class="col-lg-12">
                                                <button type="button" id="tombolAbsenManual" class="btn btn-info w-md"
                                                    style="float: right">
                                                    Tambah Pegawai
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button fw-medium collapsed" type="button"
                                                    id="accordion-button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <i class="bx bx-search-alt font-size-18"></i>
                                                    <b>Barcode</b>
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body barcodeScanner">
                                                    <div class="row text-muted">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4 text-center">
                                                            <label class="form-label">Metode Scan</label>
                                                            <div class="mb-3">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input radio" type="radio"
                                                                        name="toggle" id="inlineRadio1" value="Barcode">
                                                                    <label class="form-check-label"
                                                                        for="inlineRadio1">Barcode</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input radio" type="radio"
                                                                        name="toggle" id="inlineRadio2"
                                                                        value="Scan Kamera">
                                                                    <label class="form-check-label"
                                                                        for="inlineRadio2">Scan
                                                                        Kamera</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row text-muted div_barcode">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4">
                                                            <input type="text" name="scanner_barcode"
                                                                class="form-control scanner_barcode" id="scanner_barcode"
                                                                placeholder="NIP" autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="row text-muted div_scan_camera">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4">
                                                            <div id="qr-reader"></div>
                                                            <div id="qr-reader-results"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3"></div>

                                    <div class="col-md-12 table-responsive mt-2">
                                        <table class="table table-responsive table-bordered table-striped"
                                            id="daftarBarcode">
                                            <thead>
                                                <tr>
                                                    <th class="text-left" style="width: 10%">No</th>
                                                    <th class="text-left" style="width: 0%">id</th>
                                                    <th class="text-left" style="width: 20%">Nip</th>
                                                    <th class="text-left" style="width: 20%">Nama</th>
                                                    <th class="text-left" style="width: 20%">Waktu Absensi</th>
                                                    <th class="text-left" style="width: 20%">Absensi</th>
                                                    <th class="text-left" style="width: 10%">Keterlambatan</th>
                                                    <th class="text-left" style="width: 30%">Status</th>
                                                    <th class="text-left" style="width: 10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <button class="btn btn-primary mt-2" type="button" style="float: right"
                                            id="simpanDataBtn">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <style>
        #daftarBarcode tbody td.hidden {
            display: none;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
    <script src="{{ asset('assets/scanner/html5-qrcode.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            let counter = 1;
            let html5QrcodeScanner;
            let lastResult = null;

            // Function to renumber table rows
            function renumberTable() {
                counter = 1;
                $('#daftarBarcode tbody tr').each(function() {
                    $(this).find('td:eq(0)').text(counter++);
                });
            }

            // Initialize select2 for NIP selection
            $('#nip').select2({
                placeholder: '-- Pilih --',
                ajax: {
                    url: '{{ route('absen.pilih_pegawai') }}',
                    type: 'POST',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            _token: '{{ csrf_token() }}',
                            search: params.term
                        };
                    },
                    processResults: function(res) {
                        if (res.code === 200) {
                            return {
                                results: res.data.map(item => ({
                                    id: item.nip,
                                    text: item.nip,
                                    nama: item.nama_pegawai,
                                    departemen: item.departemen,
                                    id_pegawai: item.id_pegawai
                                }))
                            };
                        }
                        return {
                            results: []
                        };
                    },
                    cache: true
                }
            });

            // Auto-fill name when NIP is selected
            $('#nip').on('select2:select', function(e) {
                let data = e.params.data;
                $('#nama_pegawai').val(data.nama);
                $('#nip').data('nama', data.nama);
                $('#nip').data('id_pegawai', data.id_pegawai);
            });

            // Common function to calculate status and time
            // Common function to calculate status and time
            function calculateAttendanceStatus() {
                let now = new Date();
                let jamMasukStr = $('#jam_masuk').val();
                let [jm, mm, ss] = jamMasukStr.split(':');

                let jamMasuk = new Date();
                jamMasuk.setHours(parseInt(jm), parseInt(mm), parseInt(ss || 0), 0);

                let keterlambatanMenit = Math.floor((now - jamMasuk) / 60000);
                let days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                let hari = days[now.getDay()];
                let jam = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: false
                });

                return {
                    waktu: `${hari}, ${jam}`,
                    status: keterlambatanMenit <= 0 ? 'Tepat Waktu' : `Terlambat +${keterlambatanMenit} menit`,
                    menit: keterlambatanMenit <= 0 ? 0 : keterlambatanMenit,
                    jamMasukStr: jamMasukStr
                };
            }

            // Common function to add employee to table
            function addEmployeeToTable(employeeData) {
                // Check for duplicates
                let exists = $('#daftarBarcode tbody tr').toArray().some(tr => {
                    return $(tr).find('td:eq(2)').text() === employeeData.nip;
                });

                if (exists) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Pegawai ini sudah ditambahkan.',
                    });
                    return false;
                }

                let no = $('#daftarBarcode tbody tr').length + 1;
                let row = `
                <tr>
                    <td>${no}</td>
                    <td>${employeeData.id}</td>
                    <td>${employeeData.nip}</td>
                    <td>${employeeData.nama}</td>
                    <td>${employeeData.jamMasukStr}</td>
                    <td>${employeeData.waktu}</td>
                    <td>${employeeData.menit}</td>
                    <td>${employeeData.status}</td>
                    <td><button type="button" class="btn btn-danger btn-sm btn-hapus">Hapus</button></td>
                </tr>`;

                $('#daftarBarcode tbody').append(row);
                return true;
            }

            // Manual attendance button
            $('#tombolAbsenManual').click(function() {
                let nip = $('#nip').val();
                if (!nip) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Lengkapi Data!',
                        text: 'Silakan pilih NIP terlebih dahulu.',
                    });
                    return;
                }

                let attendanceData = calculateAttendanceStatus();
                attendanceData.id = $('#nip').data('id_pegawai');
                attendanceData.nip = nip;
                attendanceData.nama = $('#nip').data('nama');

                if (addEmployeeToTable(attendanceData)) {
                    $('#nip').val(null).trigger('change');
                    $('#nama_pegawai').val('');
                }
            });

            // Barcode scanner functions
            $('.div_scan_camera').hide();
            $('.div_barcode').hide();

            $('.radio').click(function() {
                let metode_scan = $(this).val();
                if (metode_scan == 'Barcode') {
                    $('.div_scan_camera').hide();
                    $('.div_barcode').show();
                    if (html5QrcodeScanner) {
                        html5QrcodeScanner.clear().catch(console.error);
                    }
                } else {
                    $('.div_scan_camera').show();
                    $('.div_barcode').hide();
                    initCameraScanner();
                }
            });

            function initCameraScanner() {
                const scannerContainer = document.getElementById('qr-reader');
                scannerContainer.innerHTML = '';

                html5QrcodeScanner = new Html5QrcodeScanner(
                    "qr-reader", {
                        fps: 10,
                        qrbox: 250,
                        supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
                    },
                    false
                );

                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            }

            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    lastResult = decodedText;
                    getValueScanBarcodeCamera(decodedText);
                    html5QrcodeScanner.pause();
                    setTimeout(() => html5QrcodeScanner.resume(), 2000);
                }
            }

            function onScanFailure(error) {
                if (error.includes('NotAllowedError')) {
                    $('#qr-reader').html(
                        '<p class="text-danger">Izin kamera ditolak. Mohon izinkan akses kamera.</p>');
                }
                console.warn(`QR scan error = ${error}`);
            }

            // Handle manual barcode input
            $(".scanner_barcode").change(function() {
                let barcode = $(this).val();
                document.getElementById('scanner_barcode').value = '';
                getValueScanBarcodeCamera(barcode);
            });

            // Get employee data from barcode
            function getValueScanBarcodeCamera(nip) {
                $.ajax({
                    url: "{{ route('absen.scanBarcode1') }}",
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        search: nip
                    },
                    success: function(response) {
                        if (response.code === 200) {
                            let dataPegawai = response.data.find(p => p.nip === nip);
                            if (dataPegawai) {
                                let attendanceData = calculateAttendanceStatus();
                                attendanceData.id = dataPegawai.id_pegawai;
                                attendanceData.nip = dataPegawai.nip;
                                attendanceData.nama = dataPegawai.nama_pegawai;

                                addEmployeeToTable(attendanceData);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'NIP Tidak Ditemukan',
                                    text: `NIP ${nip} tidak ditemukan di database.`
                                });
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Gagal memproses data pegawai.'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal mengambil data pegawai: ' + xhr.statusText
                        });
                    }
                });
            }

            // Delete row handler
            $('#daftarBarcode').on('click', '.btn-hapus', function() {
                $(this).closest('tr').remove();
                renumberTable();
            });

            // Save button handler
            $('#simpanDataBtn').click(function() {
                let attendanceData = [];
                let duplicateCheck = {};
                let hasDuplicates = false;

                // Collect data from table rows
                $('#daftarBarcode tbody tr').each(function() {
                    let nip = $(this).find('td:eq(2)').text();
                    if (duplicateCheck[nip]) {
                        hasDuplicates = true;
                        return false; // Exit loop if duplicate found
                    }
                    duplicateCheck[nip] = true;

                    attendanceData.push({
                        id_pegawai: $(this).find('td:eq(1)').text(),
                        nip: nip,
                        nama: $(this).find('td:eq(3)').text(),
                        jam_masuk: $(this).find('td:eq(4)').text(),
                        waktu_absen: $(this).find('td:eq(5)').text(),
                        keterlambatan: $(this).find('td:eq(6)').text(),
                        status: $(this).find('td:eq(7)').text()
                    });
                });

                // Validate data before sending
                if (hasDuplicates) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Duplikat Data',
                        text: 'Terdapat NIP yang duplikat dalam daftar absensi',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if (attendanceData.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Data Kosong',
                        text: 'Tidak ada data absensi yang akan disimpan',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // Show loading indicator
                Swal.fire({
                    title: 'Menyimpan Data',
                    html: 'Sedang memproses data absensi...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                // Send data to server
                $.ajax({
                    type: 'POST',
                    url: '{{ route('absensi_pegawai.store') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        absensi: attendanceData
                    },
                    success: function(response) {
                        Swal.close();
                        if (response.code == 200) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: response.message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500,
                                willClose: () => {
                                    window.location.href =
                                        '{{ route('setting_data.index') }}';
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message ||
                                    'Terjadi kesalahan saat menyimpan data',
                                willClose: () => {
                                    if (response.duplicates && response.duplicates
                                        .length > 0) {
                                        $('#daftarBarcode tbody').empty();
                                        counter = 1;
                                    }
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.message ||
                                'Terjadi kesalahan saat menyimpan data',
                            willClose: () => {
                                if (xhr.status === 422) {
                                    location.reload();
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
