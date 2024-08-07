@extends('layout/main')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Dashboard</h1>
        <!-- <a
        href="#"
        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
        ><i class="fas fa-download fa-sm text-white-50"></i> Generate
        Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-8">
            <div class="outter_shadow">
                <div class="row">
                 <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-3">
                    <div class="card h-100 py-2 dashboard_card">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="card_name">
                                    <h3>
                                        Wallet Balance
                                    </h3>
                                    <div class="arrow_icon">
                                    <span>17%</span>
                                    <img src="{{ asset('assets/img/arrow_blue.png') }}">
                                    </div>
                                </div>
                                    <h2>
                                        ${{$walletModel->balance}}
                                    </h2>
                                </div>
                                {{-- <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-3">
                    <div class="card h-100 py-2 dashboard_card">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="card_name">
                                    <h3>
                                    Revenue
                                    </h3>
                                    <div class="arrow_icon">
                                    <span>17%</span>
                                    <img src="{{ asset('assets/img/arrow_blue.png') }}">
                                    </div>
                                </div>
                                <h2>
                                        ${{$platformFee}}
                                </h2>
                                </div>
                                {{-- <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-3">
                    <div class="card h-100 py-2 dashboard_card">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="card_name">
                                    <h3>
                                        Transaction (Merchants)
                                    </h3>
                                    <div class="arrow_icon">
                                    <span>17%</span>
                                    <img src="{{ asset('assets/img/red-arrow.png') }}">
                                    </div>
                                </div>

                                            <h2>
                                                {{$merchantCounts}}
                                            </h2>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-3">
                    <div class="card h-100 py-2 dashboard_card">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="card_name">
                                    <h3>
                                        Total Cashback given
                                    </h3>
                                    <div class="arrow_icon">
                                    <span>17%</span>
                                    <img src="{{ asset('assets/img/red-arrow.png') }}">
                                    </div>
                                </div>
                                    <h2>
                                        {{$userCounts}}
                                    </h2>
                                </div>
                                {{-- <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
       <div class="col-md-4">
            <div class="outter_shadow">
                <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card h-100 py-2 dashboard_card">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="card_name">
                                    <h3>
                                        Total Merchants
                                    </h3>
                                    <div class="arrow_icon">
                                    <span>17%</span>
                                    <img src="{{ asset('assets/img/arrow_blue.png') }}">
                                    </div>
                                </div>
                                    <h2>
                                        {{$userCounts}}
                                    </h2>
                                </div>
                                {{-- <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card h-100 py-2 dashboard_card">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="card_name">
                                    <h3>
                                        Total Users
                                    </h3>
                                    <div class="arrow_icon">
                                    <span>17%</span>
                                    <img src="{{ asset('assets/img/arrow_blue.png') }}">
                                    </div>
                                </div>
                                    <h2>
                                        {{$userCounts}}
                                    </h2>
                                </div>
                                {{-- <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
       </div>
        
    </div>

    <!-- Content Row -->

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent transactions</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <hr>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Revenue Sources
                    </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Referral
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Recent transactions</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered dataTable-table" id="transaction-table" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Transaction</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                  </tr>
                </thead>

                <tbody>

                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('style')

<link href="{{ asset('/asset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endpush

@push('js')
<script>
	var transaction_datatable_url = "{{ route('admin.transaction.table') }}";
	var barCharturl = "{{ route('admin.transaction.barChart') }}";
    var transfer_data = "{{ Auth::user()->id }}";

</script>
<!-- Page level plugins -->
<script src="{{ asset('/asset/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('/asset/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('/asset/js/demo/chart-pie-demo.js') }}"></script>
<script src="{{ asset('/asset/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/asset/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('/asset/js/demo/chart-bar-demo.js') }}"></script>
<script src="{{ asset('assets') }}/js/admin/dashboard.js"></script>

@endpush
