@extends('header')
@section('content')
<!-- Main Section -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/view_admin.css') }} ">
<link href="https://fonts.googleapis.com/css?family=Blinker&display=swap" rel="stylesheet">

{{-- data table --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<section class="main-section">
    <style>
        .alert-response,
        .alert-response2,
        .alert-response3,
        .alert-response4,
        .alert-response7,
        .alert-response8 {
            display: none;
        }

        .loader,
        .loader2,
        .loader4 {
            position: absolute;
            z-index: 1000;
            left: 40%;
            top: 30%;
            height: 100px;
            display: none;
        }

        .loader3 {
            position: absolute;
            z-index: 1000;
            left: 40%;
            top: 30%;
            height: 50px;
            display: none;
        }

        #user-table_wrapper {
            margin-top: 50px;
            margin-bottom: 50px;
        }

    </style>

    <div id="content">
        @if(\Session::has('alert-sukses'))
        <div class="alert alert-info">
            <div>{{Session::get('alert-sukses')}}</div>
        </div>
        @endif

        {{-- <a href="javascript:void(0)" style="position:relative; top:10px; border-radius:10px;" class="btn btn-info ml-3" id="create-new-user">Add New</a><br><br> --}}

        {{-- data table --}}
        <table id="user-table" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Created_at</th>
                    <th>Update_at</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

</section>

{{-- modal tambah --}}
<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form id="userForm" name="userForm" class="form-horizontal">
                    <div class="form-group">
                        <label for="judul" class="col-sm-2 control-label">Judul</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="judul2" name="judul" placeholder="Masukan Judul" value=""  required="">
                        </div>
                    </div>

                    {{-- <div ></div> --}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Isi</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="isi" name="isi" placeholder="Masukan isi dari judul" value="" required="">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

{{-- modal edit --}}
<div class="modal fade" id="ajax-crudedit-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudeditModal"></h4>
            </div>
            <div class="modal-body">
                <form id="userForm2" name="userForm2" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">

                    <input type="hidden" name="gambarlama" id="gambarlama" class="form-control">

                    {{-- gambar baru --}}
                    <div class="form-group">

                        <label class="col-form-label" for="gambarlama">gambar lama</label> <br>
                        <img id="view-gambarlama" height="100"> <br><br>

                        <label class="col-form-label" for="gambarbaru">gambar baru</label>
                        <input type="file" name="gambarbaru" id="gambarbaru" class="form-control"> <br>
                    </div>
                    {{-- end gambar baru --}}

                    <div class="form-group">
                        <label for="judul" class="control-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Enter judul" value="" required="">
                    </div>

                    {{-- <div ></div> --}}
                    <div class="form-group">
                        <label class="control-label">Isi</label>
                        <textarea name="isi" id="isi_judul" class="form-control" rows="10"></textarea>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save2" value="create">Save changes
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script>
    // var SITEURL = '{{URL::to('')}}';
    var api = "{{ env('API_URL') }}";
    console.log(api);
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            "bLengthChange": false,
            "bFilter": false,
            "bPaginate": false,
            ajax: {
                url: "kelolaAbout",
                type: 'GET',
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    'visible': false
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'gambar',
                    name: 'gambar'
                },
                {
                    data: 'judul',
                    name: 'judul'
                },
                {
                    data: 'isi',
                    name: 'isi'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
            order: [
                [0, 'desc']
            ]
        });

        /* When click edit user */
        $('body').on('click', '.edit-user', function () {
            var user_id = $(this).data('id');
            $.get('kelolaAbout/' + user_id +'/edit', function (data) {
                $('#userCrudeditModal').html("Edit Data About");
                $('#ajax-crudedit-modal').modal('show');
                $("#id").val(data.id);
                $("#view-gambarlama").attr('src', data.gambar);
                $("#gambarlama").val(data.gambar);
                $("#gambarbaru").val();
                $('#judul').val(data.judul);
                $('#isi_judul').val(data.isi);
            })
        });


        $('body').on('click', '#delete-user', function () {

            var user_id = $(this).data("id");
            confirm("Anda serius ingin hapus ? data yang telah dihapus tidak bisa dikembalikan !");

            $.ajax({
                type: "get",
                url: api+"admin/hapusdataAbout/" + user_id,
                success: function (data) {
                    var oTable = $('#user-table').dataTable();
                    oTable.fnDraw(false);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    });

    // ajax add
    if ($("#userForm").length > 0) {
        $("#userForm").validate({

            submitHandler: function (form) {

                var actionType = $('#btn-save').val();
                $('#btn-save').html('Sending..');

                $.ajax({
                    data: $('#userForm').serialize(),
                    url: api+"admin/tambahTeknisi",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {

                        $('#userForm').trigger("reset");
                        $('#ajax-crud-modal').modal('hide');
                        $('#btn-save').html('Save Changes');
                        var oTable = $('#user-table').dataTable();
                        oTable.fnDraw(false);

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#btn-save').html('Save Changes');
                    }
                });
            }
        })
    }

    // ajax update
    $("#userForm2").unbind('submit').submit(function (e) {
            e.preventDefault();
                $.ajax({
                    // data: $('#userForm2').serialize(),
                    url: api+"admin/updatedataAbout",
                    type : 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "json",
                    success: function (data) {
                        $('#userForm2').trigger("reset");
                        $('#ajax-crudedit-modal').modal('hide');
                        $('#btn-save2').html('Save Changes');
                        var oTable = $('#user-table').dataTable();
                        oTable.fnDraw(false);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#btn-save2').html('Save Changes');
                    }
                });
        });

</script>


<script type="text/javascript" src="{{ asset('assets/css/view.js') }}"></script>


<!-- /.main-section -->


@endsection
