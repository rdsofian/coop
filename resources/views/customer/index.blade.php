@extends('layouts.main')

@section('content-top')
<div class="card-header border-0 py-5">
    <h3 class="card-title align-items-start flex-column">
        <span class="card-label font-weight-bold font-size-h4 text-dark-75">Nasabah</span>
        {{-- <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span> --}}
    </h3>
    <div class="card-toolbar">
        <a href="{{ route('dashboard') }}" class="btn btn-success font-weight-bolder font-size-sm">
            Dashboard</a>  &nbsp;&nbsp;
        <a href="{{ route('customer.create') }}" class="btn btn-primary font-weight-bolder font-size-sm">
            Tambah Nasabah</a>
    </div>
</div>
<!--end::Header-->
<!--begin::Body-->
<div class="card-body py-0">
    <!--begin::Table-->
    <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded" id="kt_datatable-customer">
        <thead>
            <tr>
                <th>No</th>
                <th></th>
                <th>Nama Nasabah</th>
                {{-- <th>KTP</th> --}}
                <th>Jumlah Pinjaman</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($customers as $customer)
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td nowrap="nowrap" style="width: auto">
                        <a href="{{ route('customer.show' , $customer->id) }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                        </a>
                    </td>
                    <td> {{ $customer->name }} </td>
                    {{-- <td> {{ $customer->identity_number }} </td> --}}
                    <td class="text-right">
                        @if($customer->remainingLoan() > 0)
                            <span class="label label-danger  label-pill label-inline mr-2">
                                @currency($customer->remainingLoan())
                            </span>
                        @else
                            <span class="label label-success  label-pill label-inline mr-2"">
                                @currency($customer->remainingLoan())
                            </span>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <!--end::Table-->
</div>
<!--end::Body-->
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
@endsection



@section('script')
<script>
    function deleteCustomer(id, name) {
        $('#modal-name').html(name);
        $('#modal-confirm_delete').attr('onclick', `confirmDeleteCustomer(${id})`);
        $('#deleteModal').modal('show');
    }

    function confirmDeleteCustomer(id) {
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
        $('#kt_datatable-customer').DataTable({
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
