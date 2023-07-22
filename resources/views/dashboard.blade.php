@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('page-content')

    <div class="row sparkboxes mt-4 mb-4">
        <div class="col-md-4">
            <div class="box box1">
                <div id="spark1"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box2">
                <div id="spark2"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box3">
                <div id="spark3"></div>
            </div>
        </div>
    </div>

    <div class="row justify-content-around mb-5 mt-4">
        <div class="card-group col-md-2">
            <div class="card">
                <div class="card-body pt-2">
                    <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">Till This Month</span>
                    <div class="card-title h5 d-block text-darker">
                        Opening Balance
                    </div>
                    <h4 class="">
                        &#8377;{{$openingBalance}}
                    </h4>
                </div>
            </div>
        </div>
        <div class="card-group col-md-2">
            <div class="card">
                <div class="card-body pt-2">
                    <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">Till This Month</span>
                    <div class="card-title h5 d-block text-darker">
                        Closing Balance
                    </div>
                    <h4 class="">
                        &#8377;{{$closingBalance}}
                    </h4>
                </div>
            </div>
        </div>
        {{-- <div class="card-group col-md-2">
            <div class="card">
                <div class="card-body pt-2">
                    <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">This Month</span>
                    <div class="card-title h5 d-block text-darker">
                        Highest Spend
                    </div>
                    <h4 class="">
                        &#8377;{{$highestSpend}}
                    </h4>
                </div>
            </div>
        </div> --}}
        <div class="card-group col-md-2">
            <div class="card">
                <div class="card-body pt-2">
                    <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">Till This Month</span>
                    <div class="card-title h5 d-block text-darker">
                        Total Money In
                    </div>
                    <h4 class="">
                        &#8377;{{$totalMoneyIn}}
                    </h4>
                </div>
            </div>
        </div>
        <div class="card-group col-md-2">
            <div class="card">
                <div class="card-body pt-2">
                    <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">Till This Month</span>
                    <div class="card-title h5 d-block text-darker">
                        Total Money Out
                    </div>
                    <h4 class="">
                        &#8377;{{$totalMoneyOut}}
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-sm-around">
        <div class="card mb-3 p-3 d-flex justify-content-center col-md-5">
            <div class="card-title p-3 fw-bolder fs-2">Transaction Types</div>
            <div class="card-body p-3">
                <div id="transaction_type_pie">
                </div>
            </div>
        </div>
        <div class="card mb-3 p-3 d-flex justify-content-center col-md-5">
            <div class="card-title p-3 fw-bolder fs-2">Transaction Categories</div>
            <div class="card-body p-3">
                <div id="category_pie">
                </div>
            </div>
        </div>
    </div>




    <div class="row justify-content-sm-around mt-5">
        <div class="card mb-3 p-3 d-flex justify-content-center col-md-5">
            <div class="card-title p-3 fw-bolder fs-2">Transaction trends by month</div>
            <div class="card-body p-3">
                <div id="transaction_type_line">
                </div>
            </div>
        </div>
        <div class="card mb-3 p-3 d-flex justify-content-center col-md-5">
            <div class="card-title p-3 fw-bolder fs-2">Transaction trends by categories</div>
            <div class="card-body p-3">
                <div id="category_line">
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-sm-around mt-5">
        <div class="card mb-3 p-3 d-flex justify-content-center col-md-5">
            <div class="card-title p-3 fw-bolder fs-2">Category trends by amount spend</div>
            <div class="card-body p-3">
                <div id="category_amount_line">
                </div>
            </div>
        </div>
        <div class="card mb-3 p-3 d-flex justify-content-center col-md-5">
            <div class="card-title p-3 fw-bolder fs-2">Categories and amount spend in each month</div>
            <div class="card-body p-3">
                <div id="category_month_amount_line">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>

        let seriesArray = <?php echo json_encode($typePercentageMapping); ?>;;
        let labelsArray = <?php echo json_encode($transactionsTypes); ?>;;
        var typeOptions = {
            series: seriesArray,
            chart: {
                width: 500,
                type: 'pie',
            },
            labels: labelsArray,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        seriesArray = <?php echo json_encode($categoryPercentageMapping); ?>;
        labelsArray = <?php echo json_encode($categories); ?>;

        var categoriesOptions = {
            series: seriesArray,
            chart: {
                width: 500,
                type: 'pie',
            },
            labels: labelsArray,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        let monthWiseData =  <?php echo json_encode($monthWiseData); ?>;
        var typeOptionsLine = {
            series: [{
                name: "Transactions",
                data: monthWiseData
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Transaction Trends by Month',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            }
        };

        let categoryWiseData = <?php echo json_encode($categoryWiseData); ?>;;
        let categoriesArray = <?php echo json_encode($categories); ?>;
        var categoriesOptionsLine = {
            series: [{
                name: "Transactions",
                data: categoryWiseData
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Transaction Trends by Categories',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: categoriesArray,
            }
        };

        let categoryAmountWiseData = <?php echo json_encode($categoryAmountWiseData); ?>;


        var categoryAmountOptions = {
            series: [{
                name: "Amount",
                data: categoryAmountWiseData
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Category Trends by amount',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: categoriesArray,
            }
        };

        let categoryMonthAmountWiseData = <?php echo json_encode($categoryMonthAmountWiseData); ?>;
        let shoppingData = categoryMonthAmountWiseData['Shopping']
        let financeData = categoryMonthAmountWiseData['Finance']
        let travelData = categoryMonthAmountWiseData['Travel']
        let foodData = categoryMonthAmountWiseData['food']
        let miscData = categoryMonthAmountWiseData['miscellaneous']

        console.log(categoryMonthAmountWiseData);
        var categoryMonthAmountOptions = {
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            series: [{
                name: "Shopping",
                data: shoppingData
            },
            {
                name: "Finance",
                data: financeData
            },
            {
                name: "Travel",
                data: travelData
            },
            {
                name: "food",
                data: foodData
            },
            {
                name: "miscellaneous",
                data: miscData
            },

            ],

            plotOptions: {
                    bar: {
                        horizontal: false,
                    }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories:['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
            },
            fill: {
                opacity: 1
            }
        };

        var lineChartType = new ApexCharts(document.querySelector("#transaction_type_line"), typeOptionsLine);
        lineChartType.render();

        var lineChartCategory = new ApexCharts(document.querySelector("#category_line"), categoriesOptionsLine);
        lineChartCategory.render();

        var chart = new ApexCharts(document.querySelector("#transaction_type_pie"), typeOptions);
        var chart1 = new ApexCharts(document.querySelector("#category_pie"), categoriesOptions);
        chart.render();
        chart1.render();

        var categoryAmountChart = new ApexCharts(document.querySelector("#category_amount_line"), categoryAmountOptions);
        categoryAmountChart.render();

        var categoryMonthAmountChart = new ApexCharts(document.querySelector("#category_month_amount_line"), categoryMonthAmountOptions);
        categoryMonthAmountChart.render();

    </script>
@endsection
