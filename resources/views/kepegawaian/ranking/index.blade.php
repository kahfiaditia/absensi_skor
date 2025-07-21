@extends('layouts.main')
@section('evoting')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">{{ $title }}</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Form -->
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" action="">
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Periode Awal</label>
                                        <input type="date" name="periode_awal" class="form-control"
                                            value="{{ $periode_awal }}" max="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Periode Akhir</label>
                                        <input type="date" name="periode_akhir" class="form-control"
                                            value="{{ $periode_akhir }}" max="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="col-md-3 align-self-end">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="bx bx-filter-alt"></i> Filter
                                        </button>
                                        <a href="{{ route('ranking.index') }}" class="btn btn-secondary">
                                            <i class="bx bx-reset"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Ranking Table -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Total Skor</th>
                                            <th>Rata Keterlambatan</th>
                                            <th>Jumlah Absensi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_ranking as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->nip }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->total_skor }}</td>
                                                <td>{{ $item->rata_keterlambatan }} menit</td>
                                                <td>{{ $item->jumlah_absensi }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Section -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Perkembangan Skor Harian</h5>
                            <div>
                                <canvas id="rankingChart" height="120"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('rankingChart').getContext('2d');
        const labels = {!! json_encode($date_range) !!};
        const datasets = [];

        // Prepare dataset for each employee
        @foreach ($data_ranking as $employee)
            const data_{{ $loop->index }} = [];
            @foreach ($date_range as $date)
                @php
                    $dailyScore = $daily_data[$employee->nama]->firstWhere('tanggal', $date)->skor_harian ?? 0;
                @endphp
                data_{{ $loop->parent->index }}.push({{ $dailyScore }});
            @endforeach

            datasets.push({
                label: '{{ $employee->nama }}',
                data: data_{{ $loop->index }},
                borderColor: getRandomColor(),
                backgroundColor: getRandomColor(0.2),
                tension: 0.1,
                fill: false
            });
        @endforeach

        // Create chart
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Perkembangan Skor Harian'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Skor'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    }
                }
            }
        });

        // Helper function to generate random colors
        function getRandomColor(alpha = 1) {
            const r = Math.floor(Math.random() * 255);
            const g = Math.floor(Math.random() * 255);
            const b = Math.floor(Math.random() * 255);
            return `rgba(${r}, ${g}, ${b}, ${alpha})`;
        }
    </script>
@endsection
