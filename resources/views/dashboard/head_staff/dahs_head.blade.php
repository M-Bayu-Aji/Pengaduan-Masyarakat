@extends('dashboard.templates.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">
            Report & Response Progress Chart
        </h1>

        <!-- Chart Container -->
        <div class="relative h-[400px] w-full">
            <canvas id="reportChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari PHP
    const reports = @json($reports);
    const responseProgress = @json($responseProgress);

    // Status dari response_progress
    const statuses = ['ON_PROCESS', 'DONE', 'REJECT'];

    // Filter data reports berdasarkan status response
    const statusCounts = statuses.map(status => {
        return responseProgress.filter(progress => 
            progress.response.response_status === status
        ).length;
    });

    // Chart.js Config
    const ctx = document.getElementById('reportChart').getContext('2d');
    const reportChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: statuses,
            datasets: [{
                label: 'Jumlah Reports Berdasarkan Status',
                data: statusCounts,
                backgroundColor: [
                    'rgba(255, 206, 86, 0.6)', // ON_PROCESS
                    'rgba(75, 192, 192, 0.6)',  // DONE
                    'rgba(255, 99, 132, 0.6)'   // REJECT
                ],
                borderColor: [
                    'rgba(255, 206, 86, 1)', 
                    'rgba(75, 192, 192, 1)', 
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        padding: 20,
                        font: {
                            size: 12
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endsection
