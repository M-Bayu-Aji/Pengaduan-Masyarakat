@extends('dashboard.templates.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5"></script>

    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.2);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="card-title text-white mb-2">
                                <i class="fas fa-crown text-warning me-2"></i>
                                Selamat Datang, Head Staff!
                            </h2>
                            <p class="text-white-50 mb-0">Pantau dan kelola sistem pengaduan masyarakat dengan mudah</p>
                        </div>
                        <div class="text-end">
                            <div class="text-white-50 small">Terakhir diperbarui</div>
                            <div class="text-white">{{ date('d M Y, H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-lg stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-white-50 small mb-1">Total Laporan</div>
                            <div class="h2 text-white mb-0 fw-bold">{{ $reports_count }}</div>
                            <div class="text-white-75 small">
                                <i class="fas fa-arrow-up me-1"></i>
                                +12% dari bulan lalu
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-file-alt text-white" style="font-size: 2.5rem; opacity: 0.8;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-lg stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-white-50 small mb-1">Tanggapan Aktif</div>
                            <div class="h2 text-white mb-0 fw-bold">{{ $responseProgress_count }}</div>
                            <div class="text-white-75 small">
                                <i class="fas fa-clock me-1"></i>
                                Dalam proses
                            </div>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-reply text-white" style="font-size: 2.5rem; opacity: 0.8;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Chart Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(20px);">
                <div class="card-header border-0 bg-transparent p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-1 text-dark fw-bold">
                                <i class="fas fa-chart-bar text-primary me-2"></i>
                                Analisis Laporan & Tanggapan
                            </h5>
                            <p class="text-muted small mb-0">Data real-time sistem pengaduan</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="updateChart('daily')">Harian</a></li>
                                <li><a class="dropdown-item" href="#" onclick="updateChart('weekly')">Mingguan</a></li>
                                <li><a class="dropdown-item" href="#" onclick="updateChart('monthly')">Bulanan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="chart-container position-relative">
                        <div id="bars_basic" style="width: 100%; height: 400px;"></div>
                        <div class="chart-overlay d-none" id="chartLoading">
                            <div class="d-flex justify-content-center align-items-center h-100">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(20px);">
                <div class="card-header border-0 bg-transparent p-4">
                    <h6 class="card-title mb-0 text-dark fw-bold">
                        <i class="fas fa-bolt text-warning me-2"></i>
                        Aksi Cepat
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="{{ route('head.staff.account') }}" class="text-decoration-none">
                                <div class="action-card p-3 rounded-3 text-center h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; transition: all 0.3s ease;">
                                    <i class="fas fa-users fa-2x mb-3"></i>
                                    <h6 class="mb-1">Kelola Akun Staff</h6>
                                    <small>Tambah, edit, atau hapus akun staff</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="text-decoration-none">
                                <div class="action-card p-3 rounded-3 text-center h-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; transition: all 0.3s ease;">
                                    <i class="fas fa-file-export fa-2x mb-3"></i>
                                    <h6 class="mb-1">Export Laporan</h6>
                                    <small>Unduh data dalam format Excel</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="text-decoration-none">
                                <div class="action-card p-3 rounded-3 text-center h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; transition: all 0.3s ease;">
                                    <i class="fas fa-chart-line fa-2x mb-3"></i>
                                    <h6 class="mb-1">Lihat Statistik</h6>
                                    <small>Analisis mendalam data laporan</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 16px;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
        }

        .stat-icon {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .action-card {
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .chart-container {
            position: relative;
            min-height: 400px;
        }

        .chart-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        /* Custom scrollbar for chart */
        #bars_basic::-webkit-scrollbar {
            width: 6px;
        }

        #bars_basic::-webkit-scrollbar-track {
            background: rgba(0,0,0,0.1);
        }

        #bars_basic::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 3px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .stat-card {
                margin-bottom: 1rem;
            }

            .action-card {
                margin-bottom: 1rem;
            }
        }

        /* Loading animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .loading {
            animation: pulse 1.5s ease-in-out infinite;
        }
    </style>

    <script type="text/javascript">
        let bars_basic;

        function initChart() {
            const bars_basic_element = document.getElementById('bars_basic');
            if (bars_basic_element) {
                bars_basic = echarts.init(bars_basic_element);

                const option = {
                    title: {
                        text: 'Grafik Report dan Response',
                        left: 'center',
                        textStyle: {
                            fontSize: 18,
                            fontWeight: 'bold',
                            color: '#374151'
                        }
                    },
                    color: ['#667eea', '#f5576c'],
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        },
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        borderColor: 'rgba(0,0,0,0.8)',
                        textStyle: {
                            color: '#fff'
                        }
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                    },
                    xAxis: [{
                        type: 'category',
                        data: ['Pengaduan Masuk', 'Tanggapan Aktif'],
                        axisTick: {
                            alignWithLabel: true
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#d1d5db'
                            }
                        },
                        axisLabel: {
                            color: '#6b7280',
                            fontWeight: '500'
                        }
                    }],
                    yAxis: [{
                        type: 'value',
                        axisLine: {
                            lineStyle: {
                                color: '#d1d5db'
                            }
                        },
                        axisLabel: {
                            color: '#6b7280'
                        },
                        splitLine: {
                            lineStyle: {
                                color: '#f3f4f6'
                            }
                        }
                    }],
                    series: [{
                        name: 'Total Count',
                        type: 'bar',
                        barWidth: '40%',
                        data: [
                            { value: {{ $reports_count }}, itemStyle: { color: '#667eea' } },
                            { value: {{ $responseProgress_count }}, itemStyle: { color: '#f5576c' } }
                        ],
                        label: {
                            show: true,
                            position: 'top',
                            color: '#374151',
                            fontWeight: 'bold'
                        },
                        emphasis: {
                            itemStyle: {
                                shadowBlur: 10,
                                shadowColor: 'rgba(0, 0, 0, 0.3)'
                            }
                        }
                    }],
                    animationDuration: 1000,
                    animationEasing: 'cubicOut'
                };

                bars_basic.setOption(option);

                // Resize chart on window resize
                window.addEventListener('resize', function() {
                    bars_basic.resize();
                });
            }
        }

        function updateChart(period) {
            const loading = document.getElementById('chartLoading');
            loading.classList.remove('d-none');

            // Simulate API call
            setTimeout(() => {
                // Here you would typically fetch new data based on the period
                // For now, we'll just refresh the chart
                initChart();
                loading.classList.add('d-none');
            }, 1000);
        }

        // Initialize chart when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            initChart();
        });

        // Add smooth animations to cards
        document.querySelectorAll('.stat-card, .action-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
@endsection
