@extends('layouts.main')
@section('content-top')
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bold font-size-h4 text-dark-75">Tambah Data Pinjaman</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <form method="post" action="{{ route('loan.store') }}">
            @csrf
            <div class="form-group">
                <label>No KTP</label>
                <select name="customer_id" class="form-control">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Jumlah Pinjaman</label>
                <input type="number" class="form-control" placeholder="Masukan Jumlah" name="amount" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            </div>
        </form>
        <!--end::Table-->
    </div>
@endsection
