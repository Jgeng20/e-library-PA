@extends('layouts.app')

@section('title', 'Dasbor')

@section('page-header')
    <div class="row">
        <div class="col-12">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Dasbor</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">
                                    <i class="nav-icon fas fa-tachometer-alt mr-1"></i> Dasbor
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <form class="mb-3" method="GET">
            <select name="month" onchange="this.form.submit()">
                <option value="year" {{ request('month') == 'year' ? 'selected' : '' }}>Tahun Ini</option>
                @foreach (range(1, 12) as $m)
                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                    </option>
                @endforeach
            </select>
        </form>
        <div class="row">
            <!-- Total Books -->
            <div class="col-lg col-md-3 col-sm-4 col-6 mb-3">
                <div class="small-box bg-dark text-white h-100">
                    <div class="inner d-flex justify-content-between align-items-center">
                        <div>
                            <h3>{{ $totalBooks }}</h3>
                            <p class="font-weight-bold">Total Buku</p>
                        </div>
                        @if (isset($percentageChangeTotalBooks))
                            <div class="text-center mx-auto">
                                @if ($percentageChangeTotalBooks > 0)
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/increase.png') }}" class="img-fluid"
                                        alt="increase" style="width: 50px; height: 50px;">
                                @elseif($percentageChangeTotalBooks < 0)
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/decrease.png') }}" class="img-fluid"
                                        alt="decrease" style="width: 50px; height: 50px;">
                                @else
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/equal.png') }}" class="img-fluid"
                                        alt="equal" style="width: 50px; height: 50px;">
                                @endif
                            </div>
                        @endif
                    </div>
                    @if (isset($percentageChangeTotalBooks))
                        <div class="text-center mt-n2">
                            @if ($percentageChangeTotalBooks > 0)
                                <span class="text-success">{{ number_format($percentageChangeTotalBooks, 2) }}%
                                    Peningkatan</span>
                            @elseif($percentageChangeTotalBooks < 0)
                                <span class="text-danger">{{ number_format($percentageChangeTotalBooks, 2) }}%
                                    Penurunan</span>
                            @else
                                <span class="text-blue">Tidak ada perubahan</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Rented Books -->
            <div class="col-lg col-md-3 col-sm-4 col-6 mb-3">
                <div class="small-box bg-dark text-white h-100">
                    <div class="inner d-flex justify-content-between align-items-center">
                        <div>
                            <h3>{{ $rentedBooks }}</h3>
                            <p class="font-weight-bold">Buku yang Dipinjam</p>
                        </div>
                        @if (isset($percentageChangeRented))
                            <div class="text-center mx-auto">
                                @if ($percentageChangeRented > 0)
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/increase.png') }}" class="img-fluid"
                                        alt="increase" style="width: 50px; height: 50px;">
                                @elseif($percentageChangeRented < 0)
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/decrease.png') }}" class="img-fluid"
                                        alt="decrease" style="width: 50px; height: 50px;">
                                @else
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/equal.png') }}" class="img-fluid"
                                        alt="equal" style="width: 50px; height: 50px;">
                                @endif
                            </div>
                        @endif
                    </div>
                    @if (isset($percentageChangeRented))
                        <div class="text-center mt-n2">
                            @if ($percentageChangeRented > 0)
                                <span class="text-success">{{ number_format($percentageChangeRented, 2) }}%
                                    Peningkatan</span>
                            @elseif($percentageChangeRented < 0)
                                <span class="text-danger">{{ number_format($percentageChangeRented, 2) }}% Penurunan</span>
                            @else
                                <span class="text-blue">Tidak ada perubahan</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Overdue Books -->
            <div class="col-lg col-md-3 col-sm-4 col-6 mb-3">
                <div class="small-box bg-dark text-white h-100">
                    <div class="inner d-flex justify-content-between align-items-center">
                        <div>
                            <h3>{{ $overdueBooks }}</h3>
                            <p class="font-weight-bold">Buku Terlambat</p>
                        </div>
                        @if (isset($percentageChangeOverdue))
                            <div class="text-center mx-auto">
                                @if ($percentageChangeOverdue > 0)
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/increase.png') }}" class="img-fluid"
                                        alt="increase" style="width: 50px; height: 50px;">
                                @elseif($percentageChangeOverdue < 0)
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/decrease.png') }}" class="img-fluid"
                                        alt="decrease" style="width: 50px; height: 50px;">
                                @else
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/equal.png') }}" class="img-fluid"
                                        alt="equal" style="width: 50px; height: 50px;">
                                @endif
                            </div>
                        @endif
                    </div>
                    @if (isset($percentageChangeOverdue))
                        <div class="text-center mt-n2">
                            @if ($percentageChangeOverdue > 0)
                                <span class="text-success">{{ number_format($percentageChangeOverdue, 2) }}%
                                    Peningkatan</span>
                            @elseif($percentageChangeOverdue < 0)
                                <span class="text-danger">{{ number_format($percentageChangeOverdue, 2) }}%
                                    Penurunan</span>
                            @else
                                <span class="text-blue">Tidak ada perubahan</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- On-Time Returns -->
            <div class="col-lg col-md-3 col-sm-4 col-6 mb-3">
                <div class="small-box bg-dark text-white h-100">
                    <div class="inner d-flex justify-content-between align-items-center">
                        <div>
                            <h3>{{ $onTimeReturns }}</h3>
                            <p class="font-weight-bold">Pengembalian Tepat Waktu</p>
                        </div>
                        @if (isset($percentageChangeOnTimeReturns))
                            <div class="text-center mx-auto">
                                @if ($percentageChangeOnTimeReturns > 0)
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/increase.png') }}" class="img-fluid"
                                        alt="increase" style="width: 50px; height: 50px;">
                                @elseif($percentageChangeOnTimeReturns < 0)
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/decrease.png') }}" class="img-fluid"
                                        alt="decrease" style="width: 50px; height: 50px;">
                                @else
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/equal.png') }}" class="img-fluid"
                                        alt="equal" style="width: 50px; height: 50px;">
                                @endif
                            </div>
                        @endif
                    </div>
                    @if (isset($percentageChangeOnTimeReturns))
                        <div class="text-center mt-n2">
                            @if ($percentageChangeOnTimeReturns > 0)
                                <span class="text-success">{{ number_format($percentageChangeOnTimeReturns, 2) }}%
                                    Peningkatan</span>
                            @elseif($percentageChangeOnTimeReturns < 0)
                                <span class="text-danger">{{ number_format($percentageChangeOnTimeReturns, 2) }}%
                                    Penurunan</span>
                            @else
                                <span class="text-blue">Tidak ada perubahan</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Total Members -->
            <div class="col-lg col-md-3 col-sm-4 col-6 mb-3">
                <div class="small-box bg-dark text-white h-100">
                    <div class="inner d-flex justify-content-between align-items-center">
                        <div>
                            <h3>{{ $totalMembers }}</h3>
                            <p class="font-weight-bold">Total Anggota</p>
                        </div>
                        @if (isset($percentageChangeTotalMembers))
                            <div class="text-center mx-auto">
                                @if ($percentageChangeTotalMembers > 0)
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/increase.png') }}" class="img-fluid"
                                        alt="increase" style="width: 50px; height: 50px;">
                                @elseif($percentageChangeTotalMembers < 0)
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/decrease.png') }}" class="img-fluid"
                                        alt="decrease" style="width: 50px; height: 50px;">
                                @else
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/equal.png') }}" class="img-fluid"
                                        alt="equal" style="width: 50px; height: 50px;">
                                @endif
                            </div>
                        @endif
                    </div>
                    @if (isset($percentageChangeTotalMembers))
                        <div class="text-center mt-n2">
                            @if ($percentageChangeTotalMembers > 0)
                                <span class="text-success">{{ number_format($percentageChangeTotalMembers, 2) }}%
                                    Peningkatan</span>
                            @elseif($percentageChangeTotalMembers < 0)
                                <span class="text-danger">{{ number_format($percentageChangeTotalMembers, 2) }}%
                                    Penurunan</span>
                            @else
                                <span class="text-blue">Tidak ada perubahan</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if (Auth::user()->role === 'admin')
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="text-center my-5" id="lineChartLoader">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                    <div class="card-body" id="lineChartContainer">
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="text-center my-5" id="splineChartLoader">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                    <div class="card-body" id="splineChartContainer">
                    </div>
                </div>
            </div>
        @endif

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="text-center my-5" id="barChartLoader">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                <div class="card-body" id="barChartContainer">
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="text-center my-5" id="columnChartLoader">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                <div class="card-body" id="columnChartContainer">
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="text-center my-5" id="pieChartLoader1">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                <div class="card-body" id="pieChartContainer1">
                </div>
            </div>
        </div>


        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="text-center my-5" id="pieChartLoader2">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                <div class="card-body" id="pieChartContainer2">
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="dataPointModal" tabindex="-1" role="dialog" aria-labelledby="dataPointModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataPointModalLabel">Detail Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalContent"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        // ajax linechart
        $(document).ready(function() {
            // Show loader
            $('#lineChartLoader').show();

            // AJAX request to fetch data for line chart
            $.ajax({
                url: "{{ route('dashboard.data.books_by_month') }}",
                method: 'GET',
                success: function(response) {
                    const borrowings = response.borrowings;
                    const borrowMonths = response.months;

                    // Create line chart
                    createLineChart('lineChartContainer', 'Jumlah Peminjaman Buku Per Bulan',
                        borrowMonths, borrowings);

                    // Hide loader
                    $('#lineChartLoader').hide();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', error);
                    // Hide loader in case of error
                    $('#lineChartLoader').hide();
                }
            });
        });

        function createLineChart(container, title, categories, data) {
            Highcharts.chart(container, {
                chart: {
                    type: 'line'
                },
                title: {
                    text: title
                },
                xAxis: {
                    categories: categories
                },
                yAxis: {
                    title: {
                        text: 'Jumlah Peminjaman'
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Peminjaman',
                    data: data,
                    point: {
                        events: {
                            click: function() {
                                // Set modal content
                                $('#modalContent').text('Bulan: ' + this.category + ', Jumlah: ' + this
                                    .y);
                                // Show modal
                                $('#dataPointModal').modal('show');
                            }
                        }
                    }
                }],
                tooltip: {
                    formatter: function() {
                        return 'Bulan: ' + this.x + '<br>Jumlah: ' + this.y;
                    }
                },
                exporting: {
                    enabled: true // Enable export feature
                },
                accessibility: {
                    enabled: true,
                    description: 'Line chart showing the number of book borrowings per month. The data shows a varying trend over the months.',
                    point: {
                        valueDescriptionFormat: '{index}. {xDescription}, {value}.'
                    }
                }
            });
        }
        // end script linechart
    </script>

    <script>
        // ajax piechart1
        $(document).ready(function() {
            $('#pieChartLoader1').show();

            $.ajax({
                url: "{{ route('dashboard.data.books_by_category') }}",
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#pieChartLoader1').hide();
                    createPieChart1('pieChartContainer1', 'Kategori Buku', data);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', error);
                    $('#pieChartLoader1').hide();
                }
            });
        });

        function createPieChart1(container, title, data) {
            Highcharts.chart(container, {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: title
                },
                plotOptions: {
                    pie: {
                        innerSize: '50%', // Makes it a donut chart
                        dataLabels: {
                            style: {
                                color: '#ffffff' // Data labels color in dark mode
                            }
                        },
                        point: {
                            events: {
                                click: function() {
                                    $('#modalContent').text('Category: ' + this.name + ', Value: ' + this.y);
                                    $('#dataPointModal').modal('show');
                                }
                            }
                        }
                    }
                },

                tooltip: {
                    formatter: function() {
                        return 'Category: ' + this.point.name + '<br>' +
                            'Value: ' + this.point.y + '<br>' +
                            Highcharts.numberFormat(this.percentage, 1) + '%</b><br>';
                    }
                },
                series: [{
                    name: 'Books',
                    colorByPoint: true,
                    data: data

                }],
                credits: {
                    enabled: false
                }
            });
        }
    </script>

    <script>
        // ajax piechart2
        $(document).ready(function() {
            // AJAX call untuk mendapatkan data buku
            $.ajax({
                url: "{{ route('dashboard.data.books_statue_data') }}",
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#pieChartLoader2').hide();
                    createPieChart2('pieChartContainer2', 'Status Buku', [{
                            name: 'Available Books',
                            y: data.availableBooks
                        },
                        {
                            name: 'Rented Books',
                            y: data.rentedBooks
                        },
                        {
                            name: 'Overdue Books',
                            y: data.overdueBooks
                        }
                    ]);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', error);
                    $('#pieChartLoader2').hide();
                }
            });
        });

        function createPieChart2(container, title, data) {
            Highcharts.chart(container, {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: title
                },
                plotOptions: {
                    pie: {
                        innerSize: '50%',
                        dataLabels: {
                            style: {
                                color: '#ffffff'
                            }
                        },
                        point: {
                            events: {
                                click: function() {
                                    $('#modalContent').text('Category: ' + this.name + ', Value: ' + this.y);
                                    $('#dataPointModal').modal('show');
                                }
                            }
                        }
                    }
                },
                tooltip: {
                    formatter: function() {
                        return 'Category: ' + this.point.name + '<br>' +
                            'Value: ' + this.point.y + '<br>' +
                            Highcharts.numberFormat(this.percentage, 1) + '%</b><br>';
                    }
                },
                series: [{
                    name: 'Books',
                    colorByPoint: true,
                    data: data
                }],
                credits: {
                    enabled: false
                }

            });
        }
    </script>

    <script>
        // ajax spline chart
        $(document).ready(function() {
            $('#splineChartLoader').show();

            $.ajax({
                url: "{{ route('dashboard.data.books_amount_data') }}",
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#splineChartLoader').hide();
                    createSplineChart('splineChartContainer', 'Pendapatan Bulanan', data.months, data
                        .totalRevenue, data.totalRentalFees, data.totalFines);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', error);
                    $('#splineChartLoader').hide();
                }
            });
        });

        function createSplineChart(container, title, categories, revenueData, rentalFeesData, finesData) {
            Highcharts.chart(container, {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: title
                },
                xAxis: {
                    categories: categories
                },
                yAxis: {
                    title: {
                        text: 'Jumlah'
                    }
                },
                series: [{
                    name: 'Pendapatan',
                    data: revenueData
                }, {
                    name: 'Biaya Sewa',
                    data: rentalFeesData
                }, {
                    name: 'Denda',
                    data: finesData
                }],
                credits: {
                    enabled: false
                }
            });
        }
    </script>

    <script>
        // ajax bar chart
        $.ajax({
            url: "{{ route('dashboard.data.top_borrowed_books') }}",
            method: 'GET',
            success: function(data) {
                console.log(data);
                $('#barChartLoader').hide();
                createBarChart('barChartContainer', 'Buku Terlaris', data);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ', error);
                $('#barChartLoader').hide();
            }
        });

        function createBarChart(container, title, data) {
            Highcharts.chart(container, {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: title
                },
                xAxis: {
                    categories: data.map(item => item.title),
                    title: {
                        text: 'Buku'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah Peminjaman',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                series: [{
                    name: 'Jumlah Peminjaman',
                    data: data.map(item => item.total)
                }],
                credits: {
                    enabled: false
                }
            });
        }
    </script>

    <script>
        // ajax column chart for publishers
        $.ajax({
            url: "{{ route('dashboard.data.top_borrowed_publishers') }}",
            method: 'GET',
            success: function(data) {
                console.log(data);
                $('#columnChartLoader').hide();
                createColumnChart('columnChartContainer', 'Publisher Terlaris', data
                    .publishers, data.counts);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ', error);
            }
        });

        function createColumnChart(container, title, categories, seriesData) {
            Highcharts.chart(container, {
                chart: {
                    type: 'column'
                },
                title: {
                    text: title
                },
                xAxis: {
                    categories: categories
                },
                yAxis: {
                    title: {
                        text: 'Jumlah Peminjaman'
                    }
                },
                series: [{
                    name: 'Jumlah Peminjaman',
                    data: seriesData
                }],
                credits: {
                    enabled: false
                }
            });
        }
    </script>

@endsection
