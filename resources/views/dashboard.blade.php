@extends('layouts.main')

@section('content-top')
<a href="{{ route('customer.index') }}">
    <div class="card btn btn-primary">
        <div class="card-body">
            <h5 class="card-title">Data Nasabah</h5>
            <p class="card-text">Informasi Data Nasabah dan Pinjaman</p>
        </div>
    </div>
</a>

@endsection

@section('content-bottom')

<a href="{{ route('users.index') }}">
    <div class="card btn btn-success">
        <div class="card-body">
            <h5 class="card-title">Data Petugas</h5>
            <p class="card-text">Informasi Data Petugas Aplikasi</p>
        </div>
    </div>
</a>
@endsection
