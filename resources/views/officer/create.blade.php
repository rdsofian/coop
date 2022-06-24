@extends('layouts.main')
@section('content-top')
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bold font-size-h4 text-dark-75">Tambah Data Petugas</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <form method="post" action="{{ route('officer.store') }}">
            @csrf
            <div class="form-group">
                <label>No KTP</label>
                <input type="number" class="form-control" placeholder="Masukan Nomor KTP" name="identity_number" />
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" placeholder="Masukan Nama Lengkap" name="name" />
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" placeholder="Masukan Alamat" name="address" />
            </div>
            <div class="form-group">
                <label>Telepon</label>
                <input type="text" class="form-control" placeholder="Masukan No. Yang Bisa Dihubungi" name="phone" />
            </div>
            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" class="form-control" placeholder="Tempat Lahir" name="birth_place" />
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" class="form-control" placeholder="Tanggal Lahir" name="birth_date" />
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            </div>
        </form>
        <!--end::Table-->
    </div>
@endsection
