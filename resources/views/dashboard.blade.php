@extends('layouts.app')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card p-3 shadow-sm border-0 bg-white border-start border-primary border-5">
            <h6 class="text-muted small text-uppercase">Total Penduduk</h6>
            <h3 class="mb-0 fw-bold">{{ $totalResidents }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 shadow-sm border-0 bg-white border-start border-success border-5">
            <h6 class="text-muted small text-uppercase">Laki-Laki</h6>
            <h3 class="mb-0 fw-bold">{{ $totalMale }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 shadow-sm border-0 bg-white border-start border-info border-5">
            <h6 class="text-muted small text-uppercase">Perempuan</h6>
            <h3 class="mb-0 fw-bold">{{ $totalFemale }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 shadow-sm border-0 bg-white border-start border-warning border-5">
            <h6 class="text-muted small text-uppercase">Staff/User</h6>
            <h3 class="mb-0 fw-bold">{{ $totalUsers }}</h3>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card p-3 shadow-sm border-0 bg-white">
            <h6 class="fw-bold mb-3 text-primary">Grafik Status Perkawinan</h6>
            <canvas id="maritalChart" style="max-height: 280px;"></canvas>
        </div>
    </div>
</div>

<script>
    const ctxMarital = document.getElementById('maritalChart').getContext('2d');
    new Chart(ctxMarital, {
        type: 'doughnut',
        data: {
            labels: ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'],
            datasets: [{
                data: [
                    {{ $maritalData['Belum_Kawin'] }},
                    {{ $maritalData['Kawin'] }},
                    {{ $maritalData['Cerai_Hidup'] }},
                    {{ $maritalData['Cerai_Mati'] }}
                ],
                backgroundColor: ['#4f46e5', '#10b981', '#f59e0b', '#ef4444']
            }]
        }
    });
</script>
@endsection