@extends('layouts.layout')
@section('title', 'Dashboard')
@section('style')
    <link href="./vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./vendor/chartist/css/chartist.min.css">
    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    {{-- Card Atas --}}
    <div class="col-lg-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header flex-wrap border-0 pb-0">
                        <h1 class="text-black fs-20 mb-3">Jumlah Penjualan Bulan Ini</h1>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row align-items-center">
                            <div class="col-lg-4 mb-lg-0 mb-4 text-center">
                                @foreach ($penjualans as $penjualan)
                                    <h2>{{ $penjualan->sum_terjual }}</h2>
                                @endforeach
                                <h2>Barang</h2>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                        @foreach ($produk_jeniss as $produk_jenis)
                                            @php
                                                if ($produk_jenis->id_jenis == 1) {
                                                    $jenis = 'Kebutuhan bayi';
                                                } elseif ($produk_jenis->id_jenis == 2) {
                                                    $jenis = 'Makanan ringan';
                                                } elseif ($produk_jenis->id_jenis == 3) {
                                                    $jenis = 'Makanan instan';
                                                } elseif ($produk_jenis->id_jenis == 4) {
                                                    $jenis = 'Minuman';
                                                } elseif ($produk_jenis->id_jenis == 5) {
                                                    $jenis = 'Kebutuhan Pokok';
                                                }
                                            @endphp
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center mb-sm-0 mb-3">
                                                <div>
                                                    <h4 class="fs-18 text-black">{{ $jenis }}</h4>
                                                    <span>{{ $produk_jenis->sum_terjual }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header flex-wrap border-0 pb-0">
                        <h1 class="text-black fs-20 mb-3">Chart produk</h1>
                    </div>
                    <div class="card-body pt-0">

                        <div class="row align-items-center">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><b>Chart Kebutuhan Bayi Penjualan Tinggi</b></div>
                                    <div class="panel-body">
                                        <canvas id="chart1C1" height="280" width="600"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-md-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><b>Chart Kebutuhan Bayi Penjualan Rendah</b></div>
                                    <div class="panel-body">
                                        <canvas id="chart1C2" height="280" width="600"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><b>Chart Makanan Ringan Penjualan Tinggi</b></div>
                                    <div class="panel-body">
                                        <canvas id="chart2C1" height="280" width="600"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-md-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><b>Chart Makanan Ringan Penjualan Rendah</b></div>
                                    <div class="panel-body">
                                        <canvas id="chart2C2" height="280" width="600"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><b>Chart Makanan Instan Penjualan Tinggi</b></div>
                                    <div class="panel-body">
                                        <canvas id="chart3C1" height="280" width="600"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-md-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><b>Chart Makanan Instan Penjualan Rendah</b></div>
                                    <div class="panel-body">
                                        <canvas id="chart3C2" height="280" width="600"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><b>Chart Minuman Penjualan Tinggi</b></div>
                                    <div class="panel-body">
                                        <canvas id="chart4C1" height="280" width="600"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-md-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><b>Chart Minuman Penjualan Rendah</b></div>
                                    <div class="panel-body">
                                        <canvas id="chart4C2" height="280" width="600"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><b>Chart Kebutuhan Pokok Penjualan Tinggi</b></div>
                                    <div class="panel-body">
                                        <canvas id="chart5C1" height="280" width="600"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-md-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><b>Chart Kebutuhan Pokok Penjualan Rendah</b></div>
                                    <div class="panel-body">
                                        <canvas id="chart5C2" height="280" width="600"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header flex-wrap border-0 pb-0">
                        <h1 class="text-black fs-20 mb-3">Clusttering produk</h1>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row align-items-center">
                            <form class="" action="/hitung" method="get">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="c1" class="col-sm-12 control-label">C1</label>
                                        <div class="col-sm-12">
                                            <select required class="selectpicker form-control" size="5" id="c1"
                                                name="c1" data-live-search="true">
                                                @foreach ($produks as $produk)
                                                    <option value="{{ $produk->id }}"
                                                        data-tokens="{{ $produk->nama_produk }}">
                                                        {{ $produk->nama_produk }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c2" class="col-sm-12 control-label">C2</label>
                                        <div class="col-sm-12">
                                            <select required class="selectpicker form-control" size="5" id="c2"
                                                name="c2" data-live-search="true">
                                                @foreach ($produks as $produk)
                                                    <option value="{{ $produk->id }}"
                                                        data-tokens="{{ $produk->nama_produk }}">
                                                        {{ $produk->nama_produk }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-offset-2 col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan"
                                            value="create">Run
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header flex-wrap border-0 pb-0">
                        <h1 class="text-black fs-20 mb-3">Data produk</h1>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row align-items-center">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>No Produk</th>
                                        <th>Jenis Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Stok Awal</th>
                                        <th>Terjual</th>
                                        <th>Stok Akhir</th>
                                        <th>Cluster</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tampil_produk_tinggi as $produk_tinggi)
                                        <tr>
                                            @php
                                                if ($produk_tinggi->id_jenis == 1) {
                                                    $jenis = 'Kebutuhan bayi';
                                                } elseif ($produk_tinggi->id_jenis == 2) {
                                                    $jenis = 'Makanan ringan';
                                                } elseif ($produk_tinggi->id_jenis == 3) {
                                                    $jenis = 'Makanan instan';
                                                } elseif ($produk_tinggi->id_jenis == 4) {
                                                    $jenis = 'Minuman';
                                                } elseif ($produk_tinggi->id_jenis == 5) {
                                                    $jenis = 'Kebutuhan Pokok';
                                                }
                                            @endphp
                                            @php
                                                if ($produk_tinggi->cluster == 'C1') {
                                                    $clus = 'Penjualan Tinggi';
                                                } elseif ($produk_tinggi->cluster == 'C2') {
                                                    $clus = 'Penjualan Rendah';
                                                }
                                            @endphp
                                            <td>{{ $produk_tinggi->nama_produk }}</td>
                                            <td>{{ $jenis }}</td>
                                            <td>{{ $produk_tinggi->nama_produk }}</td>
                                            <td>{{ $produk_tinggi->stok_awal }}</td>
                                            <td>{{ $produk_tinggi->terjual }}</td>
                                            <td>{{ $produk_tinggi->stok_kardus }}</td>
                                            <td>{{ $clus }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>No Produk</th>
                                        <th>Jenis Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Stok Awal</th>
                                        <th>Terjual</th>
                                        <th>Stok Akhir</th>
                                        <th>Cluster</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tampil_produk_rendah as $produk_rendah)
                                        <tr>
                                            @php
                                                if ($produk_rendah->id_jenis == 1) {
                                                    $jenis = 'Kebutuhan bayi';
                                                } elseif ($produk_rendah->id_jenis == 2) {
                                                    $jenis = 'Makanan ringan';
                                                } elseif ($produk_rendah->id_jenis == 3) {
                                                    $jenis = 'Makanan instan';
                                                } elseif ($produk_rendah->id_jenis == 4) {
                                                    $jenis = 'Minuman';
                                                } elseif ($produk_rendah->id_jenis == 5) {
                                                    $jenis = 'Kebutuhan Pokok';
                                                }
                                            @endphp
                                            @php
                                                if ($produk_rendah->cluster == 'C1') {
                                                    $clus = 'Penjualan Tinggi';
                                                } elseif ($produk_rendah->cluster == 'C2') {
                                                    $clus = 'Penjualan Rendah';
                                                }
                                            @endphp
                                            <td>{{ $produk_rendah->nama_produk }}</td>
                                            <td>{{ $jenis }}</td>
                                            <td>{{ $produk_rendah->nama_produk }}</td>
                                            <td>{{ $produk_rendah->stok_awal }}</td>
                                            <td>{{ $produk_rendah->terjual }}</td>
                                            <td>{{ $produk_rendah->stok_kardus }}</td>
                                            <td>{{ $clus }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Akhir Card Atas --}}
    {{-- Tabel --}}

    {{-- Akhir Tabel --}}
@endsection
@section('script')
    <script type="text/javascript" language="javascript"
        src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <!-- Chart piety plugin files -->
    <script src="./vendor/peity/jquery.peity.min.js"></script>

    <!-- Apex Chart -->
    <script src="./vendor/apexchart/apexchart.js"></script>

    <!-- Dashboard 1 -->
    <script src="./js/dashboard/workout-statistic.js"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>


<script>
    var url1C1 = "{{ route('chart1C1') }}";
    var NoProduk1C1 = new Array();
    var Terjual1C1 = new Array();
    $(document).ready(function () {
        $.get(url1C1, function (response) {
            response.forEach(function (data) {
                NoProduk1C1.push(data.nama_produk);
                Terjual1C1.push(data.terjual);
            });
            var ctx = document.getElementById("chart1C1").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: NoProduk1C1,
                    datasets: [{
                        label: 'Jumlah yang terjual',
                        data: Terjual1C1,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                display: false //this will remove only the label
                            }
                        }]
                    }
                }
            });
        });
    });

    var url1C2 = "{{ route('chart1C2') }}";
    var NoProduk1C2 = new Array();
    var Terjual1C2 = new Array();
    var NamaProduk1C2 = new Array();
    $(document).ready(function () {
        $.get(url1C2, function (response) {
            response.forEach(function (data) {
                NoProduk1C2.push(data.nama_produk);
                Terjual1C2.push(data.terjual);
                NamaProduk1C2.push(data.nama_produk);
            });
            var ctx = document.getElementById("chart1C2").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: NamaProduk1C2,
                    datasets: [{
                        label: 'Jumlah yang terjual',
                        data: Terjual1C2,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                display: false //this will remove only the label
                            }
                        }]
                    }
                }
            });
        });
    });
</script>

<script>
    var url2C1 = "{{ route('chart2C1') }}";
    var NoProduk2C1 = new Array();
    var Terjual2C1 = new Array();
    $(document).ready(function () {
        $.get(url2C1, function (response) {
            response.forEach(function (data) {
                NoProduk2C1.push(data.nama_produk);
                Terjual2C1.push(data.terjual);
            });
            var ctx = document.getElementById("chart2C1").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: NoProduk2C1,
                    datasets: [{
                        label: 'Jumlah yang terjual',
                        data: Terjual2C1,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                display: false //this will remove only the label
                            }
                        }]
                    }
                }
            });
        });
    });

    var url2C2 = "{{ route('chart2C2') }}";
    var NoProduk2C2 = new Array();
    var Terjual2C2 = new Array();
    $(document).ready(function () {
        $.get(url2C2, function (response) {
            response.forEach(function (data) {
                NoProduk2C2.push(data.nama_produk);
                Terjual2C2.push(data.terjual);
            });
            var ctx = document.getElementById("chart2C2").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: NoProduk2C2,
                    datasets: [{
                        label: 'Jumlah yang terjual',
                        data: Terjual2C2,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                display: false //this will remove only the label
                            }
                        }]
                    }
                }
            });
        });
    });
</script>

<script>
    var url3C1 = "{{ route('chart3C1') }}";
    var NoProduk3C1 = new Array();
    var Terjual3C1 = new Array();
    $(document).ready(function () {
        $.get(url3C1, function (response) {
            response.forEach(function (data) {
                NoProduk3C1.push(data.nama_produk);
                Terjual3C1.push(data.terjual);
            });
            var ctx = document.getElementById("chart3C1").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: NoProduk3C1,
                    datasets: [{
                        label: 'Jumlah yang terjual',
                        data: Terjual3C1,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                display: false //this will remove only the label
                            }
                        }]
                    }
                }
            });
        });
    });

    var url3C2 = "{{ route('chart3C2') }}";
    var NoProduk3C2 = new Array();
    var Terjual3C2 = new Array();
    $(document).ready(function () {
        $.get(url3C2, function (response) {
            response.forEach(function (data) {
                NoProduk3C2.push(data.nama_produk);
                Terjual3C2.push(data.terjual);
            });
            var ctx = document.getElementById("chart3C2").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: NoProduk3C2,
                    datasets: [{
                        label: 'Jumlah yang terjual',
                        data: Terjual3C2,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                display: false //this will remove only the label
                            }
                        }]
                    }
                }
            });
        });
    });
</script>

<script>
    var url4C1 = "{{ route('chart4C1') }}";
    var NoProduk4C1 = new Array();
    var Terjual4C1 = new Array();
    $(document).ready(function () {
        $.get(url4C1, function (response) {
            response.forEach(function (data) {
                NoProduk4C1.push(data.nama_produk);
                Terjual4C1.push(data.terjual);
            });
            var ctx = document.getElementById("chart4C1").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: NoProduk4C1,
                    datasets: [{
                        label: 'Jumlah yang terjual',
                        data: Terjual4C1,
                        borderWidth: 1
                    }],
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                display: false //this will remove only the label
                            }
                        }]
                    }
                }
            });
        });
    });

    var url4C2 = "{{ route('chart4C2') }}";
    var NoProduk4C2 = new Array();
    var Terjual4C2 = new Array();
    $(document).ready(function () {
        $.get(url4C2, function (response) {
            response.forEach(function (data) {
                NoProduk4C2.push(data.nama_produk);
                Terjual4C2.push(data.terjual);
            });
            var ctx = document.getElementById("chart4C2").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: NoProduk4C2,
                    datasets: [{
                        label: 'Jumlah yang terjual',
                        data: Terjual4C2,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                display: false //this will remove only the label
                            }
                        }]
                    }
                }
            });
        });
    });
</script>

<script>
    var url5C1 = "{{ route('chart5C1') }}";
    var NoProduk5C1 = new Array();
    var Terjual5C1 = new Array();
    $(document).ready(function () {
        $.get(url5C1, function (response) {
            response.forEach(function (data) {
                NoProduk5C1.push(data.nama_produk);
                Terjual5C1.push(data.terjual);
            });
            var ctx = document.getElementById("chart5C1").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: NoProduk5C1,
                    datasets: [{
                        label: 'Jumlah yang terjual',
                        data: Terjual5C1,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                display: false //this will remove only the label
                            }
                        }]
                    }
                }
            });
        });
    });

    var url5C2 = "{{ route('chart5C2') }}";
    var NoProduk5C2 = new Array();
    var Terjual5C2 = new Array();
    $(document).ready(function () {
        $.get(url5C2, function (response) {
            response.forEach(function (data) {
                NoProduk5C2.push(data.nama_produk);
                Terjual5C2.push(data.terjual);
            });
            var ctx = document.getElementById("chart5C2").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: NoProduk5C2,
                    datasets: [{
                        label: 'Jumlah yang terjual',
                        data: Terjual5C2,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                display: false //this will remove only the label
                            }
                        }]
                    }
                }
            });
        });
    });
</script>

@endsection
