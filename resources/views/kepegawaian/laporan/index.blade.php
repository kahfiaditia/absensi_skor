@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <h4 class="mb-sm-0 font-size-18">{{ $label }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">{{ ucwords($menu) }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button fw-medium <?php if (isset($_GET['name'])) {
                                        } else {
                                            echo 'collapsed';
                                        } ?>" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <i class="bx bx-search-alt font-size-18"></i>
                                            <b>Cari & Unduh Data</b>
                                        </button>
                                    </h2>

                                    <div id="collapseOne" class="accordion-collapse collapse <?php
                                    if (isset($_GET['nip']) or isset($_GET['nama']) or isset($_GET['hari_absen']) or isset($_GET['skor']) or isset($_GET['tgl_start']) or isset($_GET['tgl_end'])) {
                                        if ((isset($_GET['nip']) && $_GET['nip'] != null) || (isset($_GET['nama']) && $_GET['nama'] != null) || (isset($_GET['hari_absen']) && $_GET['hari_absen'] != null) || (isset($_GET['skor']) && $_GET['skor'] != null) || (isset($_GET['tgl_start']) && $_GET['tgl_start'] != null) || (isset($_GET['tgl_end']) && $_GET['tgl_end'] != null)) {
                                            echo 'show';
                                        }
                                    }
                                    if (isset($_GET['like'])) {
                                        if ($_GET['like'] != null) {
                                            echo 'show';
                                        }
                                    } ?>"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="text-muted">
                                                <form>
                                                    <div class="row" id="id_where">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-2 mb-2">
                                                                    <input type="text" name="nip" id="nip"
                                                                        value="{{ isset($_GET['nip']) ? $_GET['nip'] : null }}"
                                                                        class="form-control" placeholder="NIP"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="nama" id="nama"
                                                                        value="{{ isset($_GET['nama']) ? $_GET['nama'] : null }}"
                                                                        class="form-control" placeholder="Nama"
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="hari_absen" id="hari_absen"
                                                                        value="{{ isset($_GET['hari_absen']) ? $_GET['hari_absen'] : null }}"
                                                                        class="form-control" placeholder="Hari"
                                                                        autocomplete="off">
                                                                </div>


                                                                <div class="col-sm-2 mb-2">
                                                                    <input type="text" name="skor" id="skor"
                                                                        value="{{ isset($_GET['skor']) ? $_GET['skor'] : null }}"
                                                                        class="form-control" placeholder="Skor"
                                                                        autocomplete="off">
                                                                </div>



                                                                <div class="col-sm-4 mb-2">
                                                                    <div class="input-daterange input-group">

                                                                        <div class="input-daterange input-group"
                                                                            id="datepicker6" data-date-format="dd M, yyyy"
                                                                            data-date-autoclose="true"
                                                                            data-provide="datepicker"
                                                                            data-date-container='#datepicker6'>
                                                                            <input type="text" class="form-control"
                                                                                name="tgl_start" id="tgl_start"
                                                                                placeholder="Start Date"
                                                                                value="{{ isset($_GET['tgl_start']) ? $_GET['tgl_start'] : null }}" />
                                                                            <input type="text" class="form-control"
                                                                                name="tgl_end" id="tgl_end"
                                                                                placeholder="End Date"
                                                                                value="{{ isset($_GET['tgl_end']) ? $_GET['tgl_end'] : null }}" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="id_like" style="display: none">
                                                        <div class="col-md-2 mb-2">
                                                            <input type="text" name="search_manual" id="search_manual"
                                                                value="{{ isset($_GET['search_manual']) ? $_GET['search_manual'] : null }}"
                                                                class="form-control" placeholder="Search">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-2 mb-2">
                                                            <div class="form-check form-check-right mb-3">
                                                                <input class="form-check-input" name="like"
                                                                    type="checkbox" id="like"
                                                                    value="{{ isset($_GET['like']) ? 'search' : 'default' }}"
                                                                    {{ isset($_GET['like']) ? 'checked' : null }}
                                                                    onclick="toggleCheckbox()">
                                                                <label class="form-check-label" for="like">
                                                                    Like semua data
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-10 mb-2">
                                                            <button type="submit"
                                                                class="btn btn-primary w-md">Cari</button>
                                                            <a href="{{ route('absensi_laporan.index') }}"
                                                                class="btn btn-secondary w-md">Batal</a>
                                                            @if (isset($_GET['kode']) or isset($_GET['like']))
                                                                <?php
                                                                $nip = $_GET['nip'];
                                                                $nama = $_GET['nama'];
                                                                $hari_absen = $_GET['hari_absen'];
                                                                
                                                                $skor = $_GET['skor'];
                                                                
                                                                $tgl_start = $_GET['tgl_start'];
                                                                $tgl_end = $_GET['tgl_end'];
                                                                if (isset($_GET['type'])) {
                                                                    $type = $_GET['type'];
                                                                } else {
                                                                    $type = null;
                                                                }
                                                                $search_manual = $_GET['search_manual'];
                                                                if (isset($_GET['like'])) {
                                                                    $like = $_GET['like'];
                                                                } else {
                                                                    $like = null;
                                                                }
                                                                ?>
                                                                <a href="{{ route(
                                                                    'export_data',
                                                                    'nip=' .
                                                                        $nip .
                                                                        '&nama=' .
                                                                        $nama .
                                                                        '&hari_absen=' .
                                                                        $hari_absen .
                                                                        '&skor=' .
                                                                        $skor .
                                                                        '&tgl_start=' .
                                                                        $tgl_start .
                                                                        '&tgl_end=' .
                                                                        $tgl_end .
                                                                        '&type=' .
                                                                        $type .
                                                                        '&search_manual=' .
                                                                        $search_manual .
                                                                        '&like=' .
                                                                        $like .
                                                                        '',
                                                                ) }}"
                                                                    class="btn btn-success btn-rounded waves-effect waves-light w-md"><i
                                                                        class="bx bx-cloud-download me-1"></i>Unduh
                                                                    Excel</a>
                                                            @else
                                                                <a href="{{ route('export_data') }}"
                                                                    class="btn btn-success btn-rounded waves-effect waves-light w-md"><i
                                                                        class="bx bx-cloud-download me-1"></i>Unduh</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <table id="datatable" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Hari</th>
                                        <th>Absen</th>
                                        <th>Terlambat</th>
                                        <th>Skor</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/alert.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize datepicker
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                orientation: 'bottom'
            });

            // For range datepicker
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                orientation: 'bottom'
            });
        });

        function toggleCheckbox() {
            like = document.getElementById("like").checked;
            if (like == true) {
                document.getElementById("nip").value = null;
                document.getElementById("nama").value = null;
                document.getElementById("hari_absen").value = null;
                document.getElementById("tgl_start").value = null;
                document.getElementById("tgl_end").value = null;
                document.getElementById("skor").value = null;
                // document.getElementById("keterangan").value = null;
                // document.getElementById("name").value = null;
                $('#type').val("").trigger('change')
                document.getElementById("id_where").style.display = 'none';
                document.getElementById("id_like").style.display = 'block';
            } else {
                document.getElementById("search_manual").value = null;
                document.getElementById("like").checked = false;
                document.getElementById("id_like").style.display = 'none';
                document.getElementById("id_where").style.display = 'block';
            }
        }

        $(document).ready(function() {
            like = document.getElementById("like").checked;
            if (like == true) {
                document.getElementById("nip").value = null;
                document.getElementById("nama").value = null;
                document.getElementById("hari_absen").value = null;
                document.getElementById("tgl_start").value = null;
                document.getElementById("tgl_end").value = null;
                document.getElementById("skor").value = null;
                // document.getElementById("keterangan").value = null;
                $('#type').val("").trigger('change')
                document.getElementById("id_where").style.display = 'none';
                document.getElementById("id_like").style.display = 'block';
            } else {
                document.getElementById("search_manual").value = null;
                document.getElementById("like").checked = false;
                document.getElementById("id_like").style.display = 'none';
                document.getElementById("id_where").style.display = 'block';
            }

            // var i = document.getElementById("kode_transaksi").value = null;
            // console.log(i);

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('get_data_laporan') }}",
                    data: function(d) {
                        d.nip = (document.getElementById("nip").value
                                .length != 0) ?
                            document
                            .getElementById(
                                "nip").value : null;
                        d.nama = (document.getElementById("nama").value.length != 0) ?
                            document
                            .getElementById(
                                "nama").value : null;
                        d.hari_absen = (document.getElementById("hari_absen").value.length != 0) ?
                            document
                            .getElementById(
                                "hari_absen").value : null;
                        d.skor = (document.getElementById("skor").value.length != 0) ?
                            document
                            .getElementById(
                                "skor").value : null;
                        d.tgl_start = (document.getElementById("tgl_start").value.length != 0) ?
                            document
                            .getElementById(
                                "tgl_start").value : null;
                        d.tgl_end = (document.getElementById("tgl_end").value.length != 0) ?
                            document
                            .getElementById(
                                "tgl_end").value : null;
                        d.search_manual = (document.getElementById("search_manual").value
                                .length != 0) ?
                            document
                            .getElementById(
                                "search_manual").value : null;
                        d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: null,
                        sortable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }

                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'hari_absen',
                        name: 'hari_absen',
                        render: function(data, type, row) {
                            console.log("hari_absen:", data); // Add this line to log the value
                            if (data == 0) {
                                return '';
                            }
                            return data;
                        }
                    },
                    {
                        data: 'absen_karyawan',
                        name: 'absen_karyawan'
                    },
                    {
                        data: 'keterlambatan',
                        name: 'keterlambatan'
                    },
                    {
                        data: 'skor',
                        name: 'skor'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },

                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false
                    // },
                ]
            });

        });
    </script>
@endsection
