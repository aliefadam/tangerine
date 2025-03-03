@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex items-center">
                <div class="inline-flex flex-shrink-0 justify-center items-center w-12 h-12 text-white bg-custom rounded-lg">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="flex-grow ml-4">
                    <p class="text-sm font-medium text-gray-600">Transaction Count</p>
                    <h3 class="text-xl font-bold">{{ $dashboard['transaction_count'] }}</h3>
                </div>
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex items-center">
                <div
                    class="inline-flex flex-shrink-0 justify-center items-center w-12 h-12 text-white bg-green-500 rounded-lg">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="flex-grow ml-4">
                    <p class="text-sm font-medium text-gray-600">Income</p>
                    <h3 class="text-xl font-bold">{{ format_rupiah($dashboard['income']) }}</h3>
                </div>
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex items-center">
                <div
                    class="inline-flex flex-shrink-0 justify-center items-center w-12 h-12 text-white bg-yellow-500 rounded-lg">
                    <i class="fas fa-users"></i>
                </div>
                <div class="flex-grow ml-4">
                    <p class="text-sm font-medium text-gray-600">Member</p>
                    <h3 class="text-xl font-bold">{{ $dashboard['member_count'] }}</h3>
                </div>
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex items-center">
                <div
                    class="inline-flex flex-shrink-0 justify-center items-center w-12 h-12 text-white bg-red-500 rounded-lg">
                    <i class="fas fa-box"></i>
                </div>
                <div class="flex-grow ml-4">
                    <p class="text-sm font-medium text-gray-600">Class Count</p>
                    <h3 class="text-xl font-bold">{{ $dashboard['class_count'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
        <div class="p-4 bg-white rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-4">Transaction at {{ date('Y') }}</h4>
            <div id="yearlyChart" style="width: 100%; height: 300px">
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-4">Transaction by Class</h4>
            <div id="categoryChart" style="width: 100%; height: 300px"></div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const yearlyChart = echarts.init(document.getElementById("yearlyChart"));
        const dataYearlyChart = @json($dashboard['transaction_per_month']);

        const yearlyOption = {
            animation: false,
            tooltip: {
                trigger: "axis",
            },
            xAxis: {
                type: "category",
                data: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "Mei",
                    "Jun",
                    "Jul",
                    "Agu",
                    "Sep",
                    "Okt",
                    "Nov",
                    "Des",
                ],
            },
            yAxis: {
                type: "value",
            },
            series: [{
                data: dataYearlyChart.map((data) => data.total_transactions),
                type: "line",
                smooth: true,
                lineStyle: {
                    color: "#4F46E5",
                },
                areaStyle: {
                    color: {
                        type: "linear",
                        x: 0,
                        y: 0,
                        x2: 0,
                        y2: 1,
                        colorStops: [{
                                offset: 0,
                                color: "rgba(79, 70, 229, 0.3)",
                            },
                            {
                                offset: 1,
                                color: "rgba(79, 70, 229, 0)",
                            },
                        ],
                    },
                },
            }, ],
        };
        yearlyChart.setOption(yearlyOption);


        const categoryChart = echarts.init(
            document.getElementById("categoryChart")
        );
        const dataCategories = @json($dashboard['transaction_per_category']);
        console.log(dataCategories);

        const categoryOption = {
            animation: false,
            tooltip: {
                trigger: "item",
            },
            legend: {
                // top: "1%",
                left: "center",
            },
            series: [{
                top: "20px",
                type: "pie",
                radius: ["20%", "60%"],
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 5,
                    borderColor: "#fff",
                    borderWidth: 2,
                },
                label: {
                    show: false,
                    position: "center",
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: "14",
                        fontWeight: "bold",
                    },
                },
                labelLine: {
                    show: false,
                },
                data: dataCategories.map((data) => {
                    return {
                        name: data.name,
                        value: data.count,
                    }
                })
            }],
        };

        categoryChart.setOption(categoryOption);
        window.addEventListener("resize", function() {
            yearlyChart.resize();
            categoryChart.resize();
        });
        document
            .getElementById("user-menu-button")
            .addEventListener("click", function() {
                document.getElementById("user-menu").classList.toggle("hidden");
            });
    </script>
@endsection
