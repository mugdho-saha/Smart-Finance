@extends('layouts.theme')

@section('content')

    <div class="page-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Dashboard</h4>
                        </div><!--end col-->

                    </div><!--end row-->
                </div><!--end page-title-box-->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div><!--end col-->
        </div><!--end row-->
        <!-- end page title end breadcrumb -->

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-3">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold">Total Expense Today</p>
                                <h3 class="m-0">{{bd_money_format($today_expense)}}</h3>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
            <div class="col-md-6 col-lg-3">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold">Total Income Today</p>
                                <h3 class="m-0">{{bd_money_format($today_income)}}</h3>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
            <div class="col-md-6 col-lg-3">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold">Total Monthly Expense</p>
                                <h3 class="m-0">{{bd_money_format($monthly_expense)}}</h3>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
            <div class="col-md-6 col-lg-3">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold">Total Monthly Income</p>
                                <h3 class="m-0">{{bd_money_format($monthly_income)}}</h3>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
            <div class="col-md-6 col-lg-3">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold">Total Expense</p>
                                <h3 class="m-0">{{bd_money_format($total_expense)}}</h3>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->

            <div class="col-md-6 col-lg-3">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold">Total Income</p>
                                <h3 class="m-0">{{bd_money_format($total_income)}}</h3>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
            <div class="col-md-6 col-lg-3">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold">Total Number of Categories</p>
                                <h3 class="m-0">{{$total_category}}</h3>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
            <div class="col-md-6 col-lg-3">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold">Total Number of Sub-Categories</p>
                                <h3 class="m-0">{{$total_sub_category}}</h3>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
            <div class="col-md-6 col-lg-3">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold">Remaining Cash</p>
                                <h3 class="m-0">{{bd_money_format($total_income - $total_expense)}}</h3>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div>

        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Monthly Income vs Expense ({{ date('Y') }})</h2>
                <canvas id="reportChart" height="100"></canvas>
            </div>
        </div>

    </div>

    <script>
        const ctx = document.getElementById('reportChart').getContext('2d');
        const reportChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($months), // Months
                datasets: [
                    {
                        label: 'Income',
                        data: @json($incomeData),
                        backgroundColor: 'rgba(23, 97, 253, 0.6)'
                    },
                    {
                        label: 'Expense',
                        data: @json($expenseData),
                        backgroundColor: 'rgba(255, 0, 0, 0.6)'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('en-IN') + ' ৳'; // BD format
                            }
                        }
                    }
                }
            }
        });
    </script>

@endsection
