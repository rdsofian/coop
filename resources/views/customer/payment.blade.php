@extends('layouts.main')
@section('content-top')
<div class="card-header border-0 py-5">
    <h3 class="card-title align-items-start flex-column">
        <span class="card-label font-weight-bold font-size-h4 text-dark-75">Tambah Data Pembayaran  {{ $customer->name }}</span>
        {{-- <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span> --}}
    </h3>
    <div class="card-toolbar">
        <a href="{{ route('dashboard') }}" class="btn btn-success font-weight-bolder font-size-sm">
            Dashboard</a> &nbsp;&nbsp;
        <a href="{{ route('customer.index') }}" class="btn btn-primary font-weight-bolder font-size-sm">
            Nasabah</a>
    </div>
</div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <form method="post" action="{{ route('customer.payment') }}">
            @csrf
            <label for=""> <h5>Total Pinjaman @currency($customer->remainingLoan())</h5></label>
            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
            <div class="form-group">
                <label>Jumlah Pembayaran</label>
                <input type="number" class="form-control" name="payment"/>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            </div>
        </form>
        <!--end::Table-->
    </div>
@endsection
