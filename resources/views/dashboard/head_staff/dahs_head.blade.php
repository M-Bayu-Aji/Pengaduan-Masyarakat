@extends('dashboard.templates.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5"></script>

    <div class="w-full my-2 px-4">
        <h1 class="text-3xl font-bold text-gray-800 text-center mb-8">Grafik Report dan Response</h1>
        <div class="max-w-4xl mx-auto">
            <div class="w-full">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                            <div class="chart has-fixed-height" id="bars_basic" style="width: 100%; height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var bars_basic_element = document.getElementById('bars_basic');
        if (bars_basic_element) {
            var bars_basic = echarts.init(bars_basic_element);
            bars_basic.setOption({
                title: {
                    text: 'Grafik Report dan Response',
                    left: 'center',
                    textStyle: {
                        fontSize: 18,
                        fontWeight: 'bold'
                    }
                },
                color: ['#3B82F6'], // Tailwind blue-500
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
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
                    data: ['Pengaduan', 'Tanggapan'],
                    axisTick: {
                        alignWithLabel: true
                    }
                }],
                yAxis: [{
                    type: 'value'
                }],
                series: [{
                    name: 'Total Count',
                    type: 'bar',
                    barWidth: '20%',
                    data: [
                        {{ $reports_count }},
                        {{ $responseProgress_count }}
                    ]
                }]
            });

            // Resize chart on window resize
            window.addEventListener('resize', function() {
                bars_basic.resize();
            });
        }
    </script>
@endsection
