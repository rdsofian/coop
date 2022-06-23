@extends('layouts.student.main')
@section('content-header')
<h5 class="text-dark font-weight-bold my-1 mr-5">Halo, {{ $student->name }}</h5>
@endsection
@section('content-top')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block m-5">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
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
        <span class="card-label font-weight-bold font-size-h4 text-dark-75">Data Pribadi</span>
    </h3>
</div>
<!--end::Header-->
<!--begin::Body-->
<div class="card-body py-0">
    <!--begin::Table-->
    <table class="table table-separate">
        <tr>
            <td width='200px'>NRP</td>
            <td>: {{ $student->code }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>: {{ $student->name }}</td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: {{ $student->faculty->name }}</td>
        </tr>
    </table>
    <!--end::Table-->
</div>

@endsection

@section('content-bottom')
<div class="card-header border-0 py-5">
    <h3 class="card-title align-items-start flex-column">
        <span class="card-label font-weight-bold font-size-h4 text-dark-75">Data Pembimbing</span>
        <span class="text-muted mt-3 font-weight-bold font-size-sm">Form Ini Bersifat Mengikat & Tidak Diperkenankan Mengganti Area Masalah</span>
    </h3>
    @if (!$student->submission)
    <div class="card-toolbar">
        <a href="{{ route('frontend.submission') }}" class="btn btn-primary font-weight-bolder font-size-sm">
            <span class="svg-icon svg-icon-md svg-icon-white">
                <!--begin::Svg Icon | path:/keen/theme/demo1/dist/assets/media/svg/icons/Communication/Add-user.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <rect fill="#000000" opacity="0.3" x="11" y="2" width="2" height="14" rx="1"/>
                        <path d="M12.0362375,3.37797611 L7.70710678,7.70710678 C7.31658249,8.09763107 6.68341751,8.09763107 6.29289322,7.70710678 C5.90236893,7.31658249 5.90236893,6.68341751 6.29289322,6.29289322 L11.2928932,1.29289322 C11.6689749,0.916811528 12.2736364,0.900910387 12.6689647,1.25670585 L17.6689647,5.75670585 C18.0794748,6.12616487 18.1127532,6.75845471 17.7432941,7.16896473 C17.3738351,7.57947475 16.7415453,7.61275317 16.3310353,7.24329415 L12.0362375,3.37797611 Z" fill="#000000" fill-rule="nonzero"/>
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>Ajukan</a>
    </div>
    @endif
    @if (!$student->submission)
    <div class="card-toolbar">
        <a href="{{ route('frontend.recomendation') }}" class="btn btn-primary font-weight-bolder font-size-sm">
            <span class="svg-icon svg-icon-md svg-icon-white">
                <!--begin::Svg Icon | path:/keen/theme/demo1/dist/assets/media/svg/icons/Communication/Add-user.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <rect fill="#000000" opacity="0.3" x="11" y="2" width="2" height="14" rx="1"/>
                        <path d="M12.0362375,3.37797611 L7.70710678,7.70710678 C7.31658249,8.09763107 6.68341751,8.09763107 6.29289322,7.70710678 C5.90236893,7.31658249 5.90236893,6.68341751 6.29289322,6.29289322 L11.2928932,1.29289322 C11.6689749,0.916811528 12.2736364,0.900910387 12.6689647,1.25670585 L17.6689647,5.75670585 C18.0794748,6.12616487 18.1127532,6.75845471 17.7432941,7.16896473 C17.3738351,7.57947475 16.7415453,7.61275317 16.3310353,7.24329415 L12.0362375,3.37797611 Z" fill="#000000" fill-rule="nonzero"/>
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>Input Penelitian</a>
    </div>
    @endif
</div>
    <!--begin::Table-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <table class="table table-separate pt-">
            <tr>
                <td width='200px'>Nama Tema Skripsi</td>
                <td>: {{ $student->submission ? $student->submission->ploting->topic->name :  "Belum Mengajukan" }}</td>
            </tr>
            <tr>
                <td>Usulan Pembimbing</td>
                <td>: {{ $student->submission ? $student->submission->ploting->lecturer->name : "Belum Mengajukan" }}</td>
            </tr>
            <tr>
                <td>Waktu Pengajuan</td>
                <td>: {{ $student->submission ? $student->submission->created_at : "Belum Mengajukan" }}</td>
            </tr>
        </table>
        <!--end::Table-->
    </div>
@endsection
