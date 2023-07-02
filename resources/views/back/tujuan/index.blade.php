@extends('back.layouts.main')
@section('title', 'Master Penerima')
@push('css-custom')
    <link href="{{ asset('/') }}backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
@endpush

@section('breadscumb')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Penerima</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ URL::to('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Penerima</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
    @endsection
    @section('container')
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="javascript:void(0)" class="btn btn-info mb-2 mr-1" style="float: right" id="add-modal"
                                onclick="addPicture()">Tambah Data</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No WA</th>
                                    <th>Sudah Baca Undangan?</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->

        <!-- Modal -->
        <div class="modal fade" id="modal-picture" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-picture-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-penerima" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Penerima</label>
                                    <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" placeholder="Masukan Nama">
                                    <small id="emailHelp" class="form-text text-muted">Contoh : Dr. Wi Dodo Ne Gede</small>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="text" class="form-control" id="telp" name="telp" aria-describedby="emailHelp" placeholder="Masukan No Telp">
                                    <small id="emailHelp" class="form-text text-muted">Contoh 089xxxxxx</small>
                                  </div>                               
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="store-btn" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Modal --}}
    @endsection

    @push('js-custom')
        <script src="{{ asset('/') }}backend/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
        <script src="{{ asset('/') }}backend/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
        <script src="{{ asset('/') }}backend/assets/extra-libs/DataTables/datatables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    processing: true,
                    serverSide: true, //aktifkan server-side 
                    ajax: {
                        url: "{{ URL::to('master/penerima') }}", // ambil data
                        type: 'GET'
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            className: 'text-right'
                        },
                        {
                            data: 'nama',
                            name: 'nama',
                            className: 'text-center'
                        },
                        {
                            data: 'telp',
                            name: 'telp',
                            className: 'text-center'
                        },   
                        {
                            data: 'is_open',
                            name: 'is_open',
                            className: 'text-center'
                        },                     
                        {
                            data: 'action',
                            name: 'action', 
                            orderable: false,
                            searchable: false,
                            className: 'text-center'                          
                        },
                    ],
                    order: [
                        [0, 'asc'],
                        [1, 'desc']
                    ],
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $('#validatedCustomFile').change(function() {

                    let reader = new FileReader();

                    reader.onload = (e) => {

                        $('#preview-image-before-upload').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);

                });
            });
        </script>
        <script>
            function addPicture() {
                $("#modal-picture").modal('show');
                $("#modal-picture-title").html("Tambah Penerima");
            }      
                       
            $(document).ready(function() {
                if ($("#form-penerima").length > 0) {
                    $("#form-penerima").validate({
                        submitHandler: function(form) {
                            var formData = new FormData(form);
                            $('#store-btn').html('Saving . .');
                            $.ajax({
                                type: "POST",
                                url: "{{ URL::to('master/penerima/store') }}",
                                data: formData,
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function(data) {
                                    $('#form-penerima').trigger("reset");
                                    $('#modal-picture').modal("hide");
                                    $('#store-btn').html('Simpan');
                                    toastr.success('Berhasil', 'Penerima berhasil disimpan.');
                                    var oTable = $('#myTable').dataTable();
                                    oTable.fnDraw(false);                            
                                },
                                error: function(data) {
                                    console.log('Error', data);
                                    $('#tombol-simpan').html('Simpan');
                                    toastr.danger('Gagal', 'Penerima gagal disimpan');
                                }
                            });
                        }
                    });
                }

                $("body").on('click', '.kirimwa', function () {
                var msg = $(this).attr('data-msg');
                window.open(msg, '_blank');
                console.log(msg);
            });

            });
        </script>
    @endpush
