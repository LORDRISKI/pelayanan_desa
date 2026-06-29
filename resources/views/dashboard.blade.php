@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">

    <div class="p-5 mb-4 bg-primary text-white rounded-3 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(135deg, #0d6efd 0%, #0043a8 100%) !important;">
        <h2 class="fw-bold mb-1">Dashboard</h2>
        <p class="mb-0 opacity-75">Aplikasi Pelayanan Desa Sungai Itik</p>
    </div>

    <div class="row g-4">
        
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm p-4 bg-white h-100">
                <h6 class="fw-bold text-muted mb-4">Berdasarkan Status Perkawinan</h6>
                <div style="position: relative; height:300px; width:100%">
                    <canvas id="maritalStatusChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm p-4 bg-white h-100">
                <h6 class="fw-bold text-muted mb-4">Berdasarkan Jenis Kelamin</h6>
                <div style="position: relative; height:300px; width:100%">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // ------ 1. LOGIK PIE CHART (STATUS PERKAWINAN) ------
    const maritalCtx = document.getElementById('maritalStatusChart').getContext('2d');
    new Chart(maritalCtx, {
        type: 'pie',
        data: {
            labels: [
                'Kawin: {{ $kawin }}', 
                'Tidak Kawin: {{ $belumKawin }}', 
                'Janda: {{ $janda }}', 
                'Duda: {{ $duda }}'
            ],
            datasets: [{
                data: [{{ $kawin }}, {{ $belumKawin }}, {{ $janda }}, {{ $duda }}],
                backgroundColor: ['#198754', '#0d6efd', '#ffc107', '#fd7e14'], // Warna hijau, biru, kuning, orange
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        font: { size: 12 }
                    }
                }
            }
        }
    });

    // ------ 2. LOGIK BAR CHART (JENIS KELAMIN) ------
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    new Chart(genderCtx, {
        type: 'bar',
        data: {
            labels: ['Laki-laki : {{ $lakiLaki }}', 'Perempuan : {{ $perempuan }}'],
            datasets: [{
                data: [{{ $lakiLaki }}, {{ $perempuan }}],
                backgroundColor: ['#198754', '#0d6efd'], // Hijau untuk pria, Biru untuk wanita sesuai mockup
                borderWidth: 0,
                barThickness: 80 // Ketebalan bar chart
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false // Sembunyikan label dataset atas
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1 // Skala angka bulat (1, 2, 3...)
                    }
                }
            }
        }
    });
</script>
@endsection