@extends('layouts.main')

@section('content-top')
    <h3>Data Nasabah {{ $customer->name }}</h3>
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
        </tr>
    </table>
@endsection

@section('content-bottom')
    <h1>Riwayat Pinjaman</h1>
        <!--begin::Table-->
    <table class="table table-striped table-bordered table-row-bordered gy-5 gs-7 border rounded" id="kt_datatable-loan">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Tanggal Pinjaman</th>
                <th>Jumlah Pinjaman</th>
                <th>Tanggal Jatuh Tempo</th>
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
                    <td>
                        @if($loan->finish_date <= date('Y-m-d') && $loan->remaining > 0)
                            <span class="label label-danger  label-pill label-inline mr-2">
                                {{ date("d-M-Y", strtotime($loan->finish_date)) }}
                            </span>
                        @elseif ($loan->finish_date > date('Y-m-d') && $loan->remaining > 0)
                            <span class="label label-warning  label-pill label-inline mr-2">
                                {{ date("d-M-Y", strtotime($loan->finish_date)) }}
                            </span>
                        @endif
                    </td>
                    <td class="text-right"> @currency($loan->remaining)</td>
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
