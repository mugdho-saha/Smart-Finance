<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Daily Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 (remove if your layout already includes it) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Hide elements with this class when printing (fallback if Bootstrap's d-print-none isn't used) */
        @media print {
            .no-print, .btn, .form-control, .input-group, .breadcrumb {
                display: none !important;
            }

            thead {
                display: table-header-group;
            }

            /* repeat table header on each printed page */
            tfoot {
                display: table-row-group;
            }

            tr {
                page-break-inside: avoid;
            }

            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        body {
            font-size: 10px;
        }
    </style>
</head>
<body class="bg-light">
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h1 class="h3 mb-1">Daily Report</h1>
            <div class="text-muted small">
                {{--@if(!empty($fromDate) || !empty($toDate))
                    Date Range:
                    {{ $fromDate ? \Illuminate\Support\Carbon::parse($fromDate)->format('d M Y') : '—' }}
                    —
                    {{ $toDate ? \Illuminate\Support\Carbon::parse($toDate)->format('d M Y') : '—' }}
                    &middot;
                @endif--}}
                Date: {{ now()->format('d M Y') }} |
                Generated: {{ now()->format('d M Y, h:i A') }}
            </div>
        </div>

        {{-- Print button (hidden on print) --}}
        <div class="no-print">
            <button class="btn btn-primary" onclick="window.print()">
                Print
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <p>Incomes</p>
            {{-- Report Table --}}
            <div class="table-responsive">
                <table class="table table-sm table-bordered align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        {{-- Adjust columns to your data --}}
                        <th>Category</th>
                        <th>Sub-Category</th>
                        <th>Note</th>
                        <th class="text-end">Amount (৳)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($incomes ?? [] as $income)
                        <tr>
                            <td>{{ $income->category->cat_name}}</td>
                            <td>{{ $income->subCategory->sub_cat_name }}</td>
                            <td>{{ $income->note }}</td>
                            <td class="text-end">
                                {{bd_money_format($income->amount)}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No data available</td>
                        </tr>
                    @endforelse
                    </tbody>

                    {{-- Optional totals footer --}}
                    @php
                        $total = isset($incomes) ? collect($incomes)->sum(fn($r) => (float)($r['amount'] ?? 0)) : 0;
                    @endphp
                    <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total</th>
                        <th class="text-end">{{ bd_money_format($total) }}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-6">
            <p>Expenses</p>
            {{-- Report Table --}}
            <div class="table-responsive">
                <table class="table table-sm table-bordered align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        {{-- Adjust columns to your data --}}
                        <th>Category</th>
                        <th>Sub-Category</th>
                        <th>Note</th>
                        <th class="text-end">Amount (৳)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($expenses ?? [] as $expense)
                        <tr>
                            <td>{{ $expense->category->cat_name}}</td>
                            <td>{{ $expense->subCategory->sub_cat_name }}</td>
                            <td>{{ $expense->note }}</td>
                            <td class="text-end">
                                {{bd_money_format($expense->amount)}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No data available</td>
                        </tr>
                    @endforelse
                    </tbody>

                    {{-- Optional totals footer --}}
                    @php
                        $total = isset($expenses) ? collect($expenses)->sum(fn($r) => (float)($r['amount'] ?? 0)) : 0;
                    @endphp
                    <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total</th>
                        <th class="text-end">{{ bd_money_format($total) }}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    {{-- Footer note --}}
    <div class="text-center text-muted small mt-3">
        © {{ date('Y') }} — Generated by your system
    </div>
</div>

</body>
</html>
