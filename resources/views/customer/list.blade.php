@extends('layouts.main')

@section('content-top')
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bold font-size-h4 text-dark-75">Data Nasabah {{ $customer->name }}</span>
            {{-- <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span> --}}
        </h3>
        <div class="card-toolbar">
            <a href="{{ route('dashboard') }}" class="btn btn-success font-weight-bolder font-size-sm">
                Dashboard</a> &nbsp;&nbsp;
            <a href="{{ route('customer.index') }}" class="btn btn-primary font-weight-bolder font-size-sm">
                Nasabah</a>
        </div>
    </div>
    <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
        <tr>
            <th>KTP</th>
            <td>{{ $customer->identity_number }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>{{ $customer->name }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $customer->address }}</td>
        </tr>
        <tr>
            <th>Telepon</th>
            <td>{{ $customer->phone }}</td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td>{{ $customer->birth_place .", " .  $customer->birth_place}}</td>
        </tr>
        <tr>
            <th>Sisa Pinjaman</th>
            <td>
                @if($customer->remainingLoan() > 0)
                    <span class="label label-danger label-pill label-inline mr-2"">
                        @currency($customer->remainingLoan())
                    </span>

                @else
                    @currency($customer->remainingLoan())
                @endif
            </td>
            <tr>
                <td  class="text-center" colspan="2">
                    @if ($customer->remainingLoan() > 0 )
                        <a href="{{ route('customer.payment-form', $customer->id) }}" class="btn btn-success">Bayar</a>
                    @endif
                    <a href="{{ route('customer.loan', $customer->id) }}" class="btn btn-warning">Tambah</a>
                </td>
            </tr>
        </tr>
    </table>

@endsection

@section('content-bottom')
    <h3>Riwayat Pinjaman</h3>
        <!--begin::Table-->
    <table class="table table-striped table-bordered table-row-bordered gy-5 gs-7 border rounded" id="kt_datatable-loan">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Tanggal Pinjaman</th>
                <th>Jumlah Pinjaman</th>
                {{-- <th>Tanggal Jatuh Tempo</th> --}}
                <th>Sisa Pinjaman</th>
                {{-- <th>Status</th> --}}
            </tr>
        </thead>
        <tbody>
        @foreach ($customer->loans as $loan)
                <tr class="text-center">
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ date("d-M-Y", strtotime($loan->loan_date)) }} </td>
                    <td class="text-right"> @currency($loan->amount)</td>
                    {{-- <td>
                        @if($loan->finish_date <= date('Y-m-d') && $loan->remaining > 0)
                            <span class="label label-danger  label-pill label-inline mr-2">
                                {{ date("d-M-Y", strtotime($loan->finish_date)) }}
                            </span>
                        @elseif ($loan->finish_date > date('Y-m-d') && $loan->remaining > 0)
                            <span class="label label-warning  label-pill label-inline mr-2">
                                {{ date("d-M-Y", strtotime($loan->finish_date)) }}
                            </span>
                        @endif
                    </td> --}}
                    <td class="text-right">
                        @if($loan->finish_date <= date('Y-m-d') && $loan->remaining > 0)
                            <span class="label label-danger  label-pill label-inline mr-2">
                                @currency($loan->remaining)
                            </span>
                        @elseif ($loan->finish_date > date('Y-m-d') && $loan->remaining > 0)
                            <span class="label label-warning  label-pill label-inline mr-2">
                                @currency($loan->remaining)
                            </span>
                        @elseif ($loan->remaining == 0)
                            <span class="label label-success  label-pill label-inline mr-2">
                                @currency($loan->remaining)
                            </span>

                        @endif
                    </td>
                    {{-- <td class="text-center">
                        <span class="label {{ $loan->status ? 'label-danger' : 'label-success' }}  label-pill label-inline mr-2">
                            {{ $loan->status ? "Belum Lunas" : "Sudah Lunas" }}
                        </span>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#kt_datatable-loan').DataTable({
            "language": {
                "lengthMenu": "Show _MENU_",
            },
            "dom": "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });
    });
</script>
@endsection
