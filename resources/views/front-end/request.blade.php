@extends('layouts.student.main')
@section('content-header')
    <h5 class="text-dark font-weight-bold my-1 mr-5">Halo, {{ $student->name }}</h5>
@endsection
@section('content-top')
    @if ($errors->any())
        <div class="alert alert-danger m-3">
            <button type="button" class="close" data-dismiss="alert">×</button>
            Data Gagal Disimpan!
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block m-5">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bold font-size-h4 text-dark-75">Pengajuan Proyek Akhir</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <form method="post" action="{{ route('frontend.store') }}">
            @csrf
            <div class="form-group">
                <label>Nama Tema</label>
                <select name="topic_id" class="form-control" id="topic">
                    <option selected="selected" disabled="true"> -- Silahkan Pilih --</option>
                    @foreach ($topics as $tp)
                        <option value="{{ $tp->id }}">{{ $tp->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Nama Pembimbing</label>
                <select name="lecturer_id" class="form-control" id="lecturer_id">
                    {{-- @foreach ($topics as $tp)
                    <option value="{{ $tp->id }}">{{ $tp->name }}</option>
                @endforeach --}}
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary mr-2">Ajukan</button>
            </div>
        </form>
    </div>

@endsection
