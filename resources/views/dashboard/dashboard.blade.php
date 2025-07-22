@extends('layouts.main')

@section('evoting')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18 text-primary">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Overview</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Stats Cards Row -->
        <div class="row">
            <!-- Pegawai Card -->
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm border-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="text-muted fw-normal">Total Pegawai</h5>
                                <h3 class="mb-0 text-primary">{{ $jumlahPegawai }}</h3>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-soft-primary text-primary text-center">
                                    <i class="fas fa-user-tie font-size-24 align-middle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Admin Card -->
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="text-muted fw-normal">Total Administrator</h5>
                                <h3 class="mb-0 text-success">{{ $jumlahAdmin }}</h3>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-soft-success text-success text-center">
                                    <i class="fas fa-user-shield font-size-24 align-middle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row mt-4">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0 text-dark">
                            <i class="fas fa-chart-bar me-2"></i>Perbandingan Jumlah Pegawai dan Admin
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height:300px; width:100%">
                            <canvas id="comparisonChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0 text-dark">
                            <i class="fas fa-chart-pie me-2"></i>Distribusi Pengguna
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height:300px; width:100%">
                            <canvas id="distributionPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>

@push('scripts')
<!-- Load Chart.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Comparison Bar Chart
    const comparisonCtx = document.getElementById('comparisonChart').getContext('2d');
    new Chart(comparisonCtx, {
        type: 'bar',
        data: {
            labels: ['Pegawai', 'Administrator'],
            datasets: [{
                label: 'Jumlah Pengguna',
                data: [{{ $jumlahPegawai }}, {{ $jumlahAdmin }}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(75, 192, 192, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw;
                        }
                    }
                }
            }
        }
    });

    // Distribution Pie Chart
    const pieCtx = document.getElementById('distributionPieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Pegawai', 'Administrator'],
            datasets: [{
                data: [{{ $jumlahPegawai }}, {{ $jumlahAdmin }}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(75, 192, 192, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const value = context.raw;
                            const percentage = Math.round((value / total) * 100);
                            return `${context.label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush

<style>
.chart-container {
    width: 100%;
    min-height: 300px;
}
.card {
    border-radius: 10px;
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.05);
}
.avatar-sm {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
@endsection