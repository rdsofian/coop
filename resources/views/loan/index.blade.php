@extends('layouts.main')

@section('content-top')
<div class="card-header border-0 py-5">
    <h3 class="card-title align-items-start flex-column">
        <span class="card-label font-weight-bold font-size-h4 text-dark-75">Pinjaman</span>
        {{-- <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span> --}}
    </h3>
    <div class="card-toolbar">
        <a href="{{ route('loan.create') }}" class="btn btn-primary font-weight-bolder font-size-sm">Tambah Pinjaman</a>
    </div>
</div>
<!--end::Header-->
<!--begin::Body-->
<div class="card-body py-0">
    <!--begin::Table-->
    <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded" id="kt_datatable-loan">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Nasabah</th>
                <th>Tanggal Pinjaman</th>
                <th>Jumlah Pinjaman</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($loans as $loan)
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ $loan->customer->name }} </td>
                    <td> {{ $loan->loan_date }} </td>
                    <td>  @currency( $loan->amount) </td>
                    <td> {{ ($loan->status) ? "Belum Lunas" : "Lunas" }}</td>
                    <td nowrap="nowrap">
                        {{-- <a href="{{ '#' }}" onclick="deleteOfficer({{ $loan->id }}, `{{ $loan->customer->nameloan }}`)">
                            <span class="svg-icon svg-icon-danger">
                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/keen/releases/2021-04-21-040700/theme/demo1/dist/../src/media/svg/icons/Home/Trash.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="28px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                        <path
                                            d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-mds" role="document">
            <div class="modal-content shadow-sm">
                <div class="modal-body">
                    <h3 class="text-center">Apakah anda yakin untuk menghapus <span id="modal-name" class="text-danger"></span>?</h3>
                </div>
                <div class="modal-footer  d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary font-weight-bold mr-3" data-dismiss="modal">Kembali</button>
                    <button type="button" class="btn btn-danger font-weight-bold ml-3" id="modal-confirm_delete">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Table-->
</div>
<!--end::Body-->
@endsection

@section('script')
    <script>
            function deleteOfficer(id, name) {
                $('#modal-name').html(name);
                $('#modal-confirm_delete').attr('onclick', `confirmDeleteOfficer(${id})`);
                $('#deleteModal').modal('show');
            }

            function confirmDeleteOfficer(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ url('customer') }}/' + id,
                    type: 'delete', // replaced from put
                    dataType: "JSON",
                    data: {
                        "id": id // method and token not needed in data
                    },
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        var url = "{{ route('customer.index') }}"; //the url I want to redirect to
                        $(location).attr('href', url);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // this line will save you tons of hours while debugging
                        // do something here because of error
                    }
                });
            }
        </script>
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
